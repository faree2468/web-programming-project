export async function loadPayments() {
    const paymentsBody = document.getElementById('paymentsBody');
 
    const paymentsIds = {
        1: 'card',
        3: 'cash',
        7: 'bank',
    }

    try {
        let token = localStorage.getItem('user_token');
        let usr = Utils.parseJwt(token);
        const payments = await PaymentService.getPaymentsFromUser(usr.user.id)

        const emptyRow = paymentsBody.querySelector("tr.no-payments");
        if (emptyRow) emptyRow.remove();

        paymentsBody.innerHTML = "";

        for(let payment of payments) {
            const paymentData = {
                id: payment.id,
                amount: payment.amount,
                payment_date: payment.payment_date,
                bill_id: payment.bill_id,
                payment_method: paymentsIds[payment.payment_method_id]
            }

            paymentsBody.innerHTML += `
                <tr>
                    <td>${paymentData.id}</td>
                    <td>${paymentData.amount}</td>
                    <td>${paymentData.payment_date}</td>
                    <td>${paymentData.bill_id}</td>
                    <td>${paymentData.payment_method}</td>
                </tr>
            `;
        }

    } catch(e) {
        console.error(e);
    }

}