import { useState } from "react";
import { useSelector, useDispatch } from "react-redux";
import { setLoading, login, selectIsLoading} from "../reduxSlices/authSlice";
import authService from "../services/authService";
import LoadingSpinner from "./LoadingSpinner";

const Login = () => {

    const dispatch = useDispatch();

    const isLoading = useSelector(selectIsLoading);

    const [generalError, setGeneralError] = useState(null);

    const [errors, setErrors] = useState({});

    const [form, setForm] = useState({
        email: '',
        password: ''
    });

    const handleSubmit = async (e) => {
        e.preventDefault();

        setGeneralError(() => null);
        setErrors(() => {});

        if (!form.email || !form.password) return;

        try {
            dispatch(setLoading(true));

            const response = await authService.login(form);

            if (response.status === 'failed') {
                setGeneralError(() => response.data);
                dispatch(setLoading(false));
            }

            if(response.status === 'success') {
                // save token
                localStorage.setItem("token", response.data.token);
                dispatch(login(response.data.token));
                dispatch(setLoading(false));
            }

            console.log('response', response);
        } catch (err) {
            dispatch(setLoading(false));

            if (err.fields) {
                setErrors(err.fields);
            } else {
                setGeneralError(() => err.message);
            }
        }
    }

    return (
        <div className="min-h-screen flex items-center justify-center bg-white px-4">
            {
                !isLoading ?
                    <div className="w-full max-w-sm bg-white rounded-2xl p-6">

                        <div className="text-center mb-6">
                        <h1 className="text-2xl font-semibold">Welcome back</h1>
                        <p className="text-sm text-gray-500 mt-1">
                            Sign in to continue
                        </p>
                        </div>

                        <form className="space-y-4">
                        <input
                            type="email"
                            placeholder="Email"
                            className={`w-full px-4 py-3 rounded-xl border ${errors?.email ? "border-red-400" : "border-gray-200"}`}
                            value={form.email}
                            onChange={(e) => setForm({...form, email: e.target.value})}
                        />

                        {errors?.email && (
                            <p className="text-sm text-red-500 mt-1">
                            {errors.email[0]}
                            </p>
                        )}

                        <input
                            type="password"
                            placeholder="Password"
                            className={`w-full px-4 py-3 rounded-xl border ${errors?.password ? "border-red-400" : "border-gray-200"}`}
                            value={form.password}
                            onChange={(e) => setForm({...form, password: e.target.value})}
                        />
                        {errors?.password && (
                            <p className="text-sm text-red-500 mt-1">
                            {errors.password[0]}
                            </p>
                        )}

                        {generalError && (<p>{generalError}</p>)}

                        <button
                            type="submit"
                            className="w-full py-3 rounded-xl bg-blue-600 text-white font-medium active:scale-[0.98] transition"
                            onClick={handleSubmit}
                        >
                            Login
                        </button>
                        </form>

                        <p className="text-center text-sm text-gray-500 mt-5">
                        Don't have an account?{" "}
                        <a href="/register" className="text-blue-600 font-medium">
                            Sign up
                        </a>
                        </p>

                    </div>
                :
                    <LoadingSpinner message="Signing you in..." />
            }
        
        </div>
    );
}

export default Login;