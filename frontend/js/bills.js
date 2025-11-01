export function handleBills() {
    const billForm = document.getElementById('billForm');
    const billName = document.getElementById('billName');
    const billCtg = document.getElementById('ctg');
    const amount = document.getElementById('amount');
    const dueDate = document.getElementById('dueDate');
    const billsTable = document.getElementById('billsTable');
    const billsBody = document.getElementById('billsBody');

    billForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const billData = {
            name: billName.value,
            category: billCtg.value,
            amount: amount.value,
            dueDate: dueDate.value
        };
        console.log(billData);
        billsBody.innerHTML += `
            <tr>
                <td>${billData.name}</td>
                <td>${billData.category}</td>
                <td>${billData.amount}</td>
                <td>${billData.dueDate}</td>
            </tr>
        `;
    });


}