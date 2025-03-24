import React from 'react'
import CustomerLayout from '../../Layout/CustomerLayout'
import { FaCoins } from "react-icons/fa6";
import { BsBagFill } from "react-icons/bs";
import SalesChart from '../../Layout/SalesChart';

function Dashboard() {
    return (
        <div>
            <div className="d-flex align-items-center gap-3 mb-4">
                <div className="card shadow rounded border-0 bg-success text-white w-100">
                    <div className="card-body d-flex align-items-center gap-3">
                        <div className="bg-white text-dark rounded-circle shadow-lg p-3 d-flex justify-content-center align-items-center" >
                            <FaCoins className='fs-4' />
                        </div>

                        <div className='d-flex flex-column'>
                            <h4 className="card-title">Total Sales Revenue</h4>
                            <h4 className="card-text">₱10</h4>
                        </div>
                    </div>
                </div>
                <div className="card shadow rounded border-0 bg-success text-white w-100">
                    <div className="card-body d-flex align-items-center gap-3">
                        <div className="bg-white text-dark rounded-circle shadow-lg p-3 d-flex justify-content-center align-items-center" >
                            <BsBagFill className='fs-4' />
                        </div>

                        <div className='d-flex flex-column'>
                            <h4 className="card-title">Total Products Sold</h4>
                            <h4 className="card-text">1000</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h4>Sales Dashboard</h4>
                <SalesChart />
            </div>
        </div>
    )
}

Dashboard.layout = page => <CustomerLayout children={page} />
export default Dashboard