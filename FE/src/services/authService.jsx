const authService = {
    login: async(data) => {
        const res = await fetch('http://localhost:8000/api/auth/login', {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
            },
            method: 'POST',
            body: JSON.stringify(data),
        });

        const responseData = await res.json();

        if (!res.ok) {
            const errorMessage = responseData?.errors?.email?.[0] || responseData?.message || "Login failed!";

            throw {
                message: errorMessage,
                fields: responseData?.errors || null
            };
        }

        return responseData;
    }
}

export default authService;