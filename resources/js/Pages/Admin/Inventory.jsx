import React from 'react'
import AdminLayout from '../../Layout/AdminLayout'

function Inventory() {
    return (
        <div>
            <h1>INVENTORY PAGE</h1>
        </div>
    )
}

Inventory.layout = page => <AdminLayout children={page} />
export default Inventory
