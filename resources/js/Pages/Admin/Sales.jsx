import React from 'react'
import AdminLayout from '../../Layout/AdminLayout'

function Sales() {
    return (
        <div>
            <h1>SALES PAGE</h1>
        </div>
    )
}

Sales.layout = page => <AdminLayout children={page} />
export default Sales
