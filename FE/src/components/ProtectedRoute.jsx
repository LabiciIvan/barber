import { Navigate } from "react-router-dom";
import { useSelector } from "react-redux";
import LoadingSpinner from "./LoadingSpinner";
import { selectIsAuthenticated, selectIsLoading } from "../reduxSlices/authSlice";

function ProtectedRoute({ children }) {
  const isAuthenticated = useSelector(selectIsAuthenticated);

  const isLoading  = useSelector(selectIsLoading);

  if (isLoading) return <LoadingSpinner message="Loading..."/>;

  if (!isAuthenticated) return <Navigate to="/login" replace />;

  return children;
}

export default ProtectedRoute;