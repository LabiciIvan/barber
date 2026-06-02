import { Outlet } from "react-router-dom";
import Navbar from "./NavBar";
import { login, selectIsAuthenticated } from "../reduxSlices/authSlice";
import { useEffect } from "react";
import { useSelector, useDispatch } from "react-redux";



function RootLayout() {

  const dispatch = useDispatch();

  const isAuthenticated = useSelector(selectIsAuthenticated);

  useEffect(() => {
    initializeAuth(isAuthenticated);
  }, []);

  const initializeAuth = (isAuthenticated) => {
    const token = localStorage.getItem("token");
    console.log('---GET TOKEN: ' + token);
    if (!isAuthenticated && token && token.trim() !== "") {
      console.log('---dispatch login token;')
      dispatch(login(token));
    }
  };

  return (
    <div>
      <Navbar />
      <Outlet />
    </div>
  );
}

export default RootLayout;