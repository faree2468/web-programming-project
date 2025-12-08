export async function loadBills() {

    const billForm = document.getElementById('billForm');
    const billName = document.getElementById('billName');
    const billCtg = document.getElementById('ctg');
    const dueDate = document.getElementById('dueDate');
    const billsTable = document.getElementById('billsTable');
    const billsBody = document.getElementById('billsBody');

    const categoryIds = {
        1 : 'housing',
        2 : 'transportation',
        3 : 'food',
        4 : 'utilities',
        5 : 'clothing',
        6 : 'medical/healthcare'
    }

    try {
        let token = localStorage.getItem('user_token');
        let usr = Utils.parseJwt(token);
        let bills = await BillService.getBillsFromUser(usr.user.id);

        const emptyRow = billsBody.querySelector("tr.no-bills");
        if (emptyRow) emptyRow.remove();

        billsBody.innerHTML = "";

        for (let bill of bills) {
            const billData = {
                id: bill.id,
                name: bill.name,
                category_id: categoryIds[bill.category_id],
                due_date: bill.due_date,
                bstatus: bill.status
            };

            billsBody.innerHTML += `
                <tr>
                    <td>${billData.id}</td>
                    <td>${billData.name}</td>
                    <td>${billData.category_id}</td>
                    <td>${billData.due_date}</td>
                    ${billData.bstatus ? `<td style="color:green;">Paid</td>` : `<td style="color:red;">Unpaid</td>`}
                    <td>
                        <button class="payBtn"><i class="fa-solid fa-dollar-sign"></i></button>
                        <button class="deleteBtn"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            `;
        }

    } catch(err) {
        console.error(err);
    }
}

const categoryIds = {
        'housing' : 1,
        'transportation' : 2,
        'food' : 3,
        'utilities' : 4,
        'clothing' : 5,
        'medical/healthcare' : 6
    }

function addBill(e) {

    const billCtg = document.getElementById('ctg');

    e.preventDefault();

    const billData = {
            id: 0,
            name: billName.value,
            category_id: categoryIds[billCtg.value],
            due_date: dueDate.value
        };
            
        billsBody.innerHTML += `
            <tr>
                <td>${billData.id}</td>
                <td>${billData.name}</td>
                <td>${billData.category_id}</td>
                <td>${billData.due_date}</td>
                <td style="color: red">Unpaid</td>
                <td>
                    <button class="payBtn"><i class="fa-solid fa-dollar-sign"></i></button>
                    <button class="deleteBtn"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>
        `;
        billData.status = 0;
        BillService.createBill(billData);

}

export function handleBills() {
    const billForm = document.getElementById('billForm');
    const billName = document.getElementById('billName');
    const billCtg = document.getElementById('ctg');
    const dueDate = document.getElementById('dueDate');
    const billsTable = document.getElementById('billsTable');
    const billsBody = document.getElementById('billsBody');


    billForm.removeEventListener('submit', addBill);

    
    billForm.addEventListener('submit', addBill);
}

// Load all categories

export async function loadCategories() {

    const ctg = document.getElementById('ctg');
    ctg.innerHTML = ``;

    try {
        const ctgs = await CategoryService.showCategories();
        
        for(let x of ctgs) {
            ctg.innerHTML += `
                <option value=${x.name.toLowerCase()}>${x.name}</option>
            `;
            
        }

    } catch(e) {
        console.error(err);
    }
}

export function deleteBills() {
    const deleteButtons = document.querySelectorAll('#billsBody .deleteBtn');

    deleteButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();

            const row = e.target.closest('tr');
            const id = row.querySelector('td').textContent.trim();
            
            BillService.deleteBill(id);


        });
    });
}

export function payBills() {
    const payButtons = document.querySelectorAll('#billsBody .payBtn');

    payButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();

            const row = e.target.closest('tr');
            const id = row.querySelector('td').textContent.trim();
            
            
            const amount = prompt("Enter amount paid:");
            if (!amount || isNaN(amount) || amount <= 0) {
                toastr.error("Please enter a valid amount");
                return;
            }

            const methodChoice = prompt(
                "Choose payment method:\n1 = Cash\n2 = Card\n3 = Bank Transfer"
            );

            let method;
            if (methodChoice === "1") method = "cash";
            else if (methodChoice === "2") method = "card";
            else if (methodChoice === "3") method = "bank";
            else {
                toastr.error("Please enter a valid payment method");
                return;
            }

            let paymentMap = {
                "card" : 1,
                "cash": 3,
                "bank" : 7

            }

            const payment = {
                amount: amount,
                bill_id: id,
                payment_method_id: paymentMap[method]
            }

            PaymentService.createPayment(payment);
            BillService.editBillStatus(payment.bill_id, {"status" : 1});

        });
    });
}
