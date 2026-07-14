import { useState } from "react";
import { useSelector, useDispatch } from "react-redux";
import { Link, NavLink, useNavigate } from "react-router-dom";
import { logout, selectIsAuthenticated } from "../reduxSlices/authSlice";

function Navbar() {

  const dispatch = useDispatch();

  const navigate = useNavigate();

  const isAuthenticated = useSelector(selectIsAuthenticated);

  const [open, setOpen] = useState(false);

  const handleLogout = () => {
    localStorage.removeItem("token");
    dispatch(logout());
    navigate("/login");
  };

  return (
    <nav className="bg-white shadow-md border-b">
      <div className="max-w-6xl mx-auto px-4">
        <div className="flex justify-between items-center h-16">

          {/* Logo */}
          <Link to="/home" className="font-bold text-lg">
            Barber
          </Link>

          {/* Desktop menu */}
          <div className="hidden md:flex items-center gap-6">
            <NavLink to="/home" className="text-gray-600 hover:text-black">
              Home
            </NavLink>

            {!isAuthenticated ? (
              <>
                <NavLink to="/login" className="text-gray-600 hover:text-black">
                  Login
                </NavLink>
                <NavLink to="/register" className="text-gray-600 hover:text-black">
                  Sign up
                </NavLink>
              </>
            ) : (
              <button
                onClick={handleLogout}
                className="text-red-500 hover:text-red-700"
              >
                Logout
              </button>
            )}
          </div>

          {/* Mobile button */}
          <button
            className="md:hidden text-gray-700"
            onClick={() => setOpen(!open)}
          >
            ☰
          </button>
        </div>

        {/* Mobile menu */}
        {open && (
          <div className="md:hidden flex flex-col gap-3 pb-4">
            <NavLink to="/home" onClick={() => setOpen(false)}>
              Home
            </NavLink>

            {!isAuthenticated ? (
              <>
                <NavLink to="/login" onClick={() => setOpen(false)}>
                  Login
                </NavLink>
                <NavLink to="/register" onClick={() => setOpen(false)}>
                  Sign up
                </NavLink>
              </>
            ) : (
              <button
                onClick={() => {
                  handleLogout();
                  setOpen(false);
                }}
                className="text-left text-red-500"
              >
                Logout
              </button>
            )}
          </div>
        )}
      </div>
    </nav>
  );
}

export default Navbar;