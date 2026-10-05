import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import FormInput from '../components/FormInput';
import Button from '../components/Button';

export default function LoginPage() {
    const [form, setForm] = useState({ email: '', password: '' });
    const [error, setError] = useState('');
    const { login } = useAuth();
    const navigate = useNavigate();

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            await login(form);
            navigate('/');
        } catch (err) {
            setError('Invalid login credentials provided.');
        }
    };

    return (
        <div className="min-h-screen flex items-center justify-center bg-slate-900">
            <form onSubmit={handleSubmit} className="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
                <h2 className="text-2xl font-bold mb-6 text-center text-slate-800">DLSOP Portal Login</h2>
                {error && <div className="mb-4 text-red-500 text-sm bg-red-50 p-2 rounded">{error}</div>}
                <FormInput label="Email Address" type="email" value={form.email} onChange={e => setForm({...form, email: e.target.value})} />
                <FormInput label="Password" type="password" value={form.password} onChange={e => setForm({...form, password: e.target.value})} />
                <Button type="submit" className="w-full mt-2">Sign In</Button>
            </form>
        </div>
    );
}
