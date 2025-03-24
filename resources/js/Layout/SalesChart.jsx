import React from "react";
import { Bar } from "react-chartjs-2";
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    BarElement,
    Title,
    Tooltip,
    Legend
} from "chart.js";

// Register required Chart.js components
ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend);

export default function SalesChart() {
    // Dummy sales data for visualization
    const salesData = [
        { month: "Jan", totalSales: 5000 },
        { month: "Feb", totalSales: 7000 },
        { month: "Mar", totalSales: 8000 },
        { month: "Apr", totalSales: 6000 },
        { month: "May", totalSales: 9500 },
        { month: "Jun", totalSales: 7200 },
        { month: "Jul", totalSales: 8100 },
        { month: "Aug", totalSales: 8700 },
        { month: "Sep", totalSales: 9100 },
        { month: "Oct", totalSales: 7300 },
        { month: "Nov", totalSales: 8500 },
        { month: "Dec", totalSales: 9900 },
    ];

    const data = {
        labels: salesData.map((item) => item.month), // Months as labels
        datasets: [
            {
                label: "Total Sales",
                data: salesData.map((item) => item.totalSales), // Sales numbers
                backgroundColor: "rgba(75, 192, 192, 0.6)", // Bar color
                borderColor: "rgba(75, 192, 192, 1)",
                borderWidth: 1,
            },
        ],
    };

    const options = {
        responsive: true,
        plugins: {
            legend: {
                position: "top",
            },
            title: {
                display: true,
                text: "Monthly Sales Report",
            },
        },
        scales: {
            y: {
                beginAtZero: true, // Ensures bars start from zero
            },
        },
    };

    return (
        <div className="w-100 m-0 p-3">
            <Bar data={data} options={options} />
        </div>
    );
}
