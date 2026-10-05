import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';
import { AuthProvider, useAuth } from "../context/AuthContext";
import MainLayout from "../layouts/MainLayout";
import LoginPage from "../pages/LoginPage";
import DashboardPage from "../pages/DashboardPage";
import OperationsPage from "../pages/OperationsPage";

const ProtectedRoute = ({ children }) => {
    const { user, loading } = useAuth();
    if (loading) return <div className = "text-center p-12" > Loading system session... < /div>;

    // If user is logged in, show page. Otherwise let public routes handle it.
    return user ? children : < Navigate to = "/login"
    replace / > ;
};

export default function App() {
    return ( <
        AuthProvider >
        <
        BrowserRouter >
        <
        Routes >
        <
        Route path = "/login"
        element = { < LoginPage / > }
        /> <
        Route path = "/"
        element = { <
            ProtectedRoute >
            <
            MainLayout / >
            <
            /ProtectedRoute>
        } >
        <
        Route index element = { < DashboardPage / > }
        /> <
        Route path = "operations"
        element = { < OperationsPage / > }
        /> <
        /Route> <
        /Routes> <
        /BrowserRouter> <
        /AuthProvider>
    );
}
