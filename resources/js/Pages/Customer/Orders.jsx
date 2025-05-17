import React from 'react';
import CustomerLayout from '../../Layout/CustomerLayout';
import { Link, usePage } from '@inertiajs/react';
import { IoReceipt } from "react-icons/io5";
import { useRoute } from '../../../../vendor/tightenco/ziggy/';

function Orders({ orders }) {
    const route = useRoute();

    return (
        <div>
            <h2 className='text-success mb-3'>{orders.total} Orders</h2>
            <div className="card shadow rounded-lg border-0">
                <div className="card-body">
                    <table className="table">
                        <thead>
                            <tr className='text-center'>
                                <th className='text-start'>Order ID</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Cash Received</th>
                                <th>Change</th>
                                <th>Status</th>
                                <th>Ordered Date</th>
                                <th>Invoice</th>
                            </tr>
                        </thead>
                        <tbody className='text-center'>
                            {orders.data.length > 0 ? (
                                orders.data.map((order) => {
                                    const formattedDate = new Date(order.updated_at).toLocaleString("en-US", {
                                        month: "long",
                                        day: "2-digit",
                                        year: "numeric",
                                        hour: "2-digit",
                                        minute: "2-digit",
                                        hour12: true,
                                    });

                                    const orderId = order.details.length > 0 ? order.details[0].order_id : null;

                                    return (
                                        <tr className='align-middle' key={order.id}>
                                            <td className='text-start'>
                                                {orderId ? `#TUNGAL${orderId}` : 'N/A'}
                                            </td>
                                            <td>{order.quantity}</td>
                                            <td>₱{order.total}</td>
                                            <td>₱{order.cash_recieved}</td>
                                            <td>₱{order.change}</td>
                                            <td className='text-success'>{order.order_status}</td>
                                            <td>{formattedDate}</td>
                                            <td>
                                                {orderId && (
                                                    <Link
                                                        href={route('customer.invoice', { order_id: orderId })}
                                                        className='fs-5 text-dark'
                                                    >
                                                        <IoReceipt />
                                                    </Link>
                                                )}
                                            </td>
                                        </tr>
                                    );
                                })
                            ) : (
                                <tr>
                                    <td colSpan="9" className="text-center text-muted py-3">
                                        No orders found.
                                    </td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                </div>

                <div className="card-footer d-flex justify-content-between align-items-center bg-light text-success p-3">
                    <p>Showing {orders.to} out of {orders.total} Products</p>
                    <div>
                        {orders.links.map((link) => (
                            link.url ? (
                                <Link
                                    key={link.label}
                                    href={link.url}
                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                    className={`btn btn-sm me-3 ${link.active ? 'btn-success' : 'btn-outline-success'}`}
                                    style={{ textDecoration: 'none' }}
                                    preserveScroll
                                />
                            ) : (
                                <span
                                    key={link.label}
                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                    className='me-3 text-muted'
                                />
                            )
                        ))}
                    </div>
                </div>
            </div>
        </div>
    );
}

Orders.layout = page => <CustomerLayout children={page} />;
export default Orders;
