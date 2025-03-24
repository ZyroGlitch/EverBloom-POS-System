import React from 'react'
import CustomerLayout from '../../Layout/CustomerLayout'

function Profile() {
    return (
        <div>
            <h1>PROFILE PAGE</h1>
        </div>
    )
}

Profile.layout = page => <CustomerLayout children={page} />
export default Profile