import React from 'react'
import background from '../../../public/assets/images/background.jpg'
import logo from '../../../public/assets/images/logo.png'
import { useRoute } from '../../../vendor/tightenco/ziggy/src/js'
import { Link } from '@inertiajs/react'

export default function Index() {
    return (
        <div
            className='vh-100 position-relative'
            style={{ backgroundImage: `url(${background})`, backgroundSize: 'cover', backgroundPosition: 'center center', backgroundRepeat: 'no-repeat' }}
        >
            <div className="position-absolute top-0 start-0 w-100 h-100" style={{ backgroundColor: 'rgba(0, 0, 0, 0.5)' }}></div>
            <div className="d-flex justify-content-center align-items-center h-100 position-relative">
                <div className="card shadow-lg rounded-lg border-0">
                    <div className="card-body bg-light px-5 py-3">
                        <div className="text-center mb-2">
                            <img src={logo} alt="logo" className="object-fit-cover" style={{ width: '140px', height: '140px' }} />
                        </div>

                        <h1 className="text-success text-center">EverBloom</h1>
                        <p className="text-muted text-center mb-4">Your one-stop shop for all your flower needs</p>

                        <div className="mb-3">
                            <label htmlFor="username" className="form-label">Username</label>
                            <input type="text" className="form-control shadow-sm" id='username' />
                        </div>

                        <div className="mb-3">
                            <label htmlFor="password" className="form-label">Password</label>
                            <input type="password" className="form-control shadow-sm" id='password' />
                        </div>

                        <div class="form-check mb-4">
                            <input className="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault">
                                Show password
                            </label>
                        </div>

                        <Link href='/dashboard' className="btn btn-success w-100 mb-3">Log In</Link>
                    </div>
                </div>
            </div>
        </div>
    )
}

// Set this page with no default layout
Index.noLayout = true;
