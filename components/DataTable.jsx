export default function DataTable({ headers, data, renderRow }) {
    return (
        <div className="overflow-x-auto bg-white shadow rounded-lg">
            <table className="min-w-full divide-y divide-gray-200">
                <thead className="bg-gray-50">
                    <tr>
                        {headers.map((header, idx) => (
                            <th key={idx} className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{header}</th>
                        ))}
                    </tr>
                </thead>
                <tbody className="divide-y divide-gray-200">
                    {data.length > 0 ? data.map(renderRow) : (
                        <tr>
                            <td colSpan={headers.length} className="px-6 py-4 text-center text-gray-500">No records found.</td>
                        </tr>
                    )}
                </tbody>
            </table>
        </div>
    );
}
