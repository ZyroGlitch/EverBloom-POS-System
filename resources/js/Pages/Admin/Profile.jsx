import React from 'react'
import AdminLayout from '../../Layout/AdminLayout'

function Profile() {
    return (
        <div>
            <h1>PROFILE PAGE</h1>
        </div>
    )
}

Profile.layout = page => <AdminLayout children={page} />
export default Profile
