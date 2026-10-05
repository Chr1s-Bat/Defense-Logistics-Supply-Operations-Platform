import { useEffect, useState } from 'react';
import api from '../api/axios';

export default function DashboardPage() {
    const [stats, setStats] = useState({ activeOperations: 0, totalStock: 0, pendingReview: 0 });
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        api.get('/dashboard')
            .then(res => setStats(res.data))
            .finally(() => setLoading(false));
    }, []);

    if (loading) return <div className="p-6">Loading telemetry metrics...</div>;

    return (
        <div className="space-y-6">
            <h1 className="text-2xl font-bold text-slate-800">Command Dashboard Overview</h1>
            <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div className="bg-white p-6 rounded-lg shadow border-l-4 border-blue-600">
                    <p className="text-gray-500">Active Operations</p>
                    <h3 className="text-3xl font-bold mt-1">{stats.activeOperations}</h3>
                </div>
                <div className="bg-white p-6 rounded-lg shadow border-l-4 border-green-600">
                    <p className="text-gray-500">Total Stock Inventory</p>
                    <h3 className="text-3xl font-bold mt-1">{stats.totalStock}</h3>
                </div>
                <div className="bg-white p-6 rounded-lg shadow border-l-4 border-amber-500">
                    <p className="text-gray-500">Pending Review Requests</p>
                    <h3 className="text-3xl font-bold mt-1">{stats.pendingReview}</h3>
                </div>
            </div>
        </div>
    );
}
