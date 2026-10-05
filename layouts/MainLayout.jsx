import { Outlet, Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';

export default function MainLayout() {
    const { user, logout } = useAuth();
    const navigate = useNavigate();

    const handleLogout = async() => {
        try {
            await logout();
        } catch (error) {
            console.error("Logout failed:", error);
        } finally {
            navigate('/login');
        }
    };

    return ( <
        div className = "min-h-screen bg-gray-100 flex flex-col" >
        <
        nav className = "bg-slate-800 text-white px-6 py-4 flex justify-between items-center shadow" >
        <
        div className = "flex space-x-6 items-center" >
        <
        span className = "font-bold text-lg" > DLSOP Command < /span> <
        Link to = "/"
        className = "hover:text-blue-300" > Dashboard < /Link> <
        Link to = "/operations"
        className = "hover:text-blue-300" > Operations < /Link> <
        /div> <
        div className = "flex items-center space-x-4" >
        <
        span > { user && user.name }({ user && user.role }) < /span> <
        button onClick = { handleLogout }
        className = "bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition" >
        Logout <
        /button> <
        /div> <
        /nav> <
        main className = "flex-1 p-6" >
        <
        Outlet / >
        <
        /main> <
        /div>
    );
}
