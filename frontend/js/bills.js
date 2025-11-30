export async function loadBills() {

    const billForm = document.getElementById('billForm');
    const billName = document.getElementById('billName');
    const billCtg = document.getElementById('ctg');
    const amount = document.getElementById('amount');
    const dueDate = document.getElementById('dueDate');
    const billsTable = document.getElementById('billsTable');
    const billsBody = document.getElementById('billsBody');

    const categoryIds = {
        1 : 'housing',
        2 : 'transportation',
        3 : 'food',
        4 : 'utilities',
        5 : 'clothing',
        6 : 'medicalhealthcare'
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
                name: bill.name,
                category_id: categoryIds[bill.category_id],
                amount: 100,
                due_date: bill.due_date,
            };

            billsBody.innerHTML += `
                <tr>
                    <td>${billData.name}</td>
                    <td>${billData.category_id}</td>
                    <td>${billData.amount}</td>
                    <td>${billData.due_date}</td>
                </tr>
            `;
        }

    } catch(err) {
        console.error(err);
    }
}


export function handleBills() {
    const billForm = document.getElementById('billForm');
    const billName = document.getElementById('billName');
    const billCtg = document.getElementById('ctg');
    const amount = document.getElementById('amount');
    const dueDate = document.getElementById('dueDate');
    const billsTable = document.getElementById('billsTable');
    const billsBody = document.getElementById('billsBody');

    const categoryIds = {
        'housing' : 1,
        'transportation' : 2,
        'food' : 3,
        'utilities' : 4,
        'clothing' : 5,
        'medicalhealthcare' : 6
    }

    
    

    billForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const billData = {
            name: billName.value,
            category_id: categoryIds[billCtg.value],
            amount: amount.value,
            due_date: dueDate.value
        };
        // if(billsBody.children[0].className == "no-bills")
        //     billsTable.deleteRow(1);
            
        billsBody.innerHTML += `
            <tr>
                <td>${billData.name}</td>
                <td>${billData.category_id}</td>
                <td>${billData.amount}</td>
                <td>${billData.due_date}</td>
            </tr>
        `;
        delete billData.amount;
        billData.status = 0;
        console.log(billData);
        BillService.createBill(billData);
    });


}

