import { jwtDecode } from "jwt-decode";

export const BACKEND_FASTAPI = "http://89.116.20.146:8003/api/";
// export const BACKEND_FASTAPI = "http://localhost:8003/api/";

export const ACCESS_TOKEN_NAME = "rizfan_access_token";
export const REFRESH_TOKEN_NAME = "rizfan_refresh_token";

export let ACCESS_TOKEN: string | null = null;
export let REFRESH_TOKEN: string | null = null;
export let AUTHORIZATION = "";
export let DECODE_TOKEN: { exp: number; id: string } | undefined;

if (typeof window !== "undefined") {
  ACCESS_TOKEN = localStorage.getItem(ACCESS_TOKEN_NAME);
  REFRESH_TOKEN = localStorage.getItem(REFRESH_TOKEN_NAME);
  AUTHORIZATION = `Bearer ${ACCESS_TOKEN}`;
  DECODE_TOKEN = ACCESS_TOKEN ? jwtDecode(ACCESS_TOKEN) : undefined;
}

// Role constants
export const ROLE_ADMIN = "admin";
export const ROLE_USER = "user";
