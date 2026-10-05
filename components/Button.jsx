export default function Button({ children, onClick, type = 'submit', variant = 'primary', className = '' }) {
    const baseStyle = "px-4 py-2 rounded font-semibold transition text-white ";
    const variants = {
        primary: "bg-blue-600 hover:bg-blue-700",
        danger: "bg-red-600 hover:bg-red-700",
        secondary: "bg-gray-600 hover:bg-gray-700"
    };

    return (
        <button type={type} onClick={onClick} className={`${baseStyle} ${variants[variant]} ${className}`}>
            {children}
        </button>
    );
}
