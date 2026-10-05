export default function FormInput({ label, name, type = 'text', value, onChange, error }) {
    return (
        <div className="mb-4">
            <label className="block text-gray-700 font-medium mb-1">{label}</label>
            <input
                type={type}
                name={name}
                value={value}
                onChange={onChange}
                className={`w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring ${error ? 'border-red-500 ring-red-200' : 'border-gray-300 ring-blue-200'}`}
            />
            {error && <p className="text-red-500 text-sm mt-1">{error}</p>}
        </div>
    );
}
