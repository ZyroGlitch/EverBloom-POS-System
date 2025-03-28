import React from 'react'
import CustomerLayout from '../../Layout/CustomerLayout'
import { Link } from '@inertiajs/react'
import { FaTrash } from "react-icons/fa6";
import { BsCartFill } from "react-icons/bs";

function Cart() {
    return (
        <div>
            <div className="d-flex justify-content-evenly">
                <div className="col-md-7">
                    <div className="card shadow rounded border-0">
                        <div className="card-header bg-success text-light d-flex justify-content-between align-items-center">
                            <h4>Cart</h4>
                            <h4>5 Items</h4>
                        </div>
                        <div className="card-body">
                            <table class="table">
                                <thead className='text-center'>
                                    <tr>
                                        <th></th>
                                        <th className='text-start'>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody className='text-center'>
                                    <tr className='align-middle'>
                                        <td>
                                            <input className="form-check-input shadow-sm" type="checkbox" value="" id="flexCheckDefault"></input>
                                        </td>
                                        <td className='text-start'>Product 1</td>
                                        <td>₱800</td>
                                        <td>5</td>
                                        <td>₱800</td>
                                        <td>
                                            <Link className='text-danger'><FaTrash /></Link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div className="col-md-4">
                    <div className="card shadow rounded border-0">
                        <div className="card-body">
                            <h4 className='text-success mb-3'>Order Summary</h4>
                            <div className="d-flex justify-content-between align-items-center mb-2">
                                <p className='fw-bold'>Items</p>
                                <p>5 Items</p>
                            </div>
                            <div className="d-flex justify-content-between align-items-center mb-2">
                                <p className='fw-bold'>Total</p>
                                <p>₱800</p>
                            </div>
                            <hr />

                            <div className="mb-4">
                                <label htmlFor="cash" className="form-label text-dark fw-bold mb-2">Cash received</label>
                                <input
                                    type="number"
                                    className="form-control shadow-sm"
                                    id='cash'
                                    min='1'
                                />
                            </div>


                            <div className="d-flex justify-content-between align-items-center mb-4">
                                <p className='fw-bold'>Change</p>
                                <p>₱800</p>
                            </div>

                            <Link className='btn btn-primary w-100 shadow d-flex justify-content-center align-items-center gap-2'><BsCartFill /> Checkout</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

Cart.layout = page => <CustomerLayout children={page} />
export default Cart