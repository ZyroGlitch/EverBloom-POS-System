import React from 'react'
import CustomerLayout from '../../Layout/CustomerLayout'

function Cart() {
    return (
        <div>
            <h1>CART PAGE</h1>
        </div>
    )
}

Cart.layout = page => <CustomerLayout children={page} />
export default Cart