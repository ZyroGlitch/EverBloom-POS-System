import React from 'react'
import AdminLayout from '../../Layout/AdminLayout'

function Dashboard() {
    return (
        <div>
            <h1>ADMIN DASHBOARD PAGE</h1>
        </div>
    )
}

Dashboard.layout = page => <AdminLayout children={page} />
export default Dashboard
