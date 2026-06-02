import { useSelector } from "react-redux";
import { Navigate } from "react-router-dom";
import { selectIsAuthenticated } from "../reduxSlices/authSlice";

function PublicRoute({ children }) {
  const isAuthenticated = useSelector(selectIsAuthenticated);

  if (isAuthenticated) return <Navigate to="/app" replace />;

  return children;
}

export default PublicRoute;