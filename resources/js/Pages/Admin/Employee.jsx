import React from 'react'
import AdminLayout from '../../Layout/AdminLayout'

function Employee() {
    return (
        <div>
            <h1>EMPLOYEE PAGE</h1>
        </div>
    )
}

Employee.layout = page => <AdminLayout children={page} />
export default Employee
