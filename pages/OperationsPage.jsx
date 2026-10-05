import { useEffect, useState } from 'react';
import api from '../api/axios';
import DataTable from '../components/DataTable';
import Button from '../components/Button';

export default function OperationsPage() {
    const [operations, setOperations] = useState([{
        id: 1,
        operation_code: 'OP-2026-001',
        personnel: { name: 'Test Officer' },
        item: { name: 'Tactical Rations' },
        quantity_allocated: 50,
        status: 'Active'
    }]);
    const [search, setSearch] = useState('');
    const [statusFilter, setStatusFilter] = useState('');
    const [page, setPage] = useState(1);
    const [meta, setMeta] = useState({});

    const fetchOperations = () => {
        api.get(`/operations?search=${search}&status=${statusFilter}&page=${page}`)
            .then(res => {
                setOperations(res.data.data);
                setMeta(res.data);
            })
            .catch(err => console.error("Error fetching operations:", err));
    };

    useEffect(() => {
        fetchOperations();
    }, [search, statusFilter, page]);

    const handleStatusChange = async(id, newStatus) => {
        try {
            await api.patch(`/operations/${id}/status`, { status: newStatus });
            fetchOperations();
        } catch (err) {
            console.error("Error updating status:", err);
        }
    };

    const handleSubmitOperation = () => {
        // Implement your submit / create log action modal or API handler here
        alert("Submit New Operation button clicked!");
    };

    return ( <
        div className = "space-y-6" >
        <
        div className = "flex justify-between items-center" >
        <
        h1 className = "text-2xl font-bold text-slate-800" > Tactical Operations Logs < /h1> <
        button onClick = { handleSubmitOperation }
        className = "bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-semibold shadow transition" >
        +Submit Operation <
        /button> <
        /div>

        <
        div className = "flex space-x-4" >
        <
        input type = "text"
        placeholder = "Search code or item..."
        value = { search }
        onChange = { e => setSearch(e.target.value) }
        className = "px-3 py-2 border rounded-lg bg-white" /
        >
        <
        select value = { statusFilter }
        onChange = { e => setStatusFilter(e.target.value) }
        className = "px-3 py-2 border rounded-lg bg-white" >
        <
        option value = "" > All Statuses < /option> <
        option value = "Pending" > Pending < /option> <
        option value = "Active" > Active < /option> <
        option value = "Completed" > Completed < /option> <
        /select> <
        /div>

        <
        DataTable headers = {
            ['Operation Code', 'Personnel', 'Item', 'Quantity', 'Status', 'Actions'] }
        data = { operations }
        renderRow = {
            (op) => ( <
                tr key = { op.id } >
                <
                td className = "px-6 py-4 whitespace-nowrap font-medium" > { op.operation_code } < /td> <
                td className = "px-6 py-4 whitespace-nowrap" > { op.personnel && op.personnel.name } < /td> <
                td className = "px-6 py-4 whitespace-nowrap" > { op.item && op.item.name } < /td> <
                td className = "px-6 py-4 whitespace-nowrap" > { op.quantity_allocated } < /td> <
                td className = "px-6 py-4 whitespace-nowrap" >
                <
                span className = { `px-2 py-1 text-xs rounded font-semibold ${
                op.status === 'Active' ? 'bg-green-100 text-green-800' :
                op.status === 'Pending' ? 'bg-amber-100 text-amber-800' :
                'bg-blue-100 text-blue-800'
            }` } > { op.status } <
                /span> <
                /td> <
                td className = "px-6 py-4 whitespace-nowrap space-x-2" > {
                    op.status === 'Pending' && ( <
                        button onClick = {
                            () => handleStatusChange(op.id, 'Active') }
                        className = "text-xs bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700" >
                        Approve / Activate <
                        /button>
                    )
                } {
                    op.status === 'Active' && ( <
                        button onClick = {
                            () => handleStatusChange(op.id, 'Completed') }
                        className = "text-xs bg-blue-600 text-white px-2 py-1 rounded hover:bg-blue-700" >
                        Complete <
                        /button>
                    )
                } <
                /td> <
                /tr>
            )
        }
        /> <
        /div>
    );
}
