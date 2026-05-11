import { Navigate } from "react-router-dom";
import { useSelector } from "react-redux";
import LoadingSpinner from "./LoadingSpinner";

function ProtectedRoute({ children }) {
  const { isAuthenticated, isLoading } = useSelector(s => s.auth);

  if (isLoading) return <LoadingSpinner message="Loading..."/>;

  if (!isAuthenticated) return <Navigate to="/login" replace />;

  return children;
}

export default ProtectedRoute;