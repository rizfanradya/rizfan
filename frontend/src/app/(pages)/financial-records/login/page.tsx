"use client";
import { useState } from "react";
import { Typography, Input, Button } from "@/app/components/materialTailwind";
import { FaEye, FaEyeSlash } from "react-icons/fa6";
import { useForm } from "react-hook-form";
import axiosInstance from "@/utils/axiosInstance";
import Swal from "sweetalert2";
import {
  ACCESS_TOKEN,
  ACCESS_TOKEN_NAME,
  REFRESH_TOKEN_NAME,
  ROLE_ADMIN,
} from "@/utils/constant";

export default function Login() {
  const [loading, setLoading] = useState(false);
  const [passwordShown, setPasswordShown] = useState(false);
  const togglePasswordVisiblity = () => setPasswordShown((cur) => !cur);
  const { register, watch } = useForm<{
    email: string;
    password: string;
  }>();

  async function onLogin() {
    setLoading(true);
    try {
      const response = await axiosInstance.post(
        `token`,
        {
          username: watch("email"),
          password: watch("password"),
        },
        { headers: { "Content-Type": "application/x-www-form-urlencoded" } }
      );

      if (response.data.role !== ROLE_ADMIN) {
        Swal.fire({
          icon: "warning",
          title: "Role Not Supported",
          text: "User role is not supported",
          allowOutsideClick: false,
        });
      }

      if (typeof window !== "undefined") {
        localStorage.setItem(ACCESS_TOKEN_NAME, response.data.access_token);
        localStorage.setItem(REFRESH_TOKEN_NAME, response.data.refresh_token);
      }
      setTimeout(() => {
        window.location.href = "/financial-records";
      }, 200);
    } catch (error) {
      console.log(error);
      Swal.fire({
        icon: "warning",
        title: "Incorrect",
        text: "Username or Password is incorrect",
        allowOutsideClick: false,
      });
    }
    setLoading(false);
  }

  if (ACCESS_TOKEN) {
    window.location.href = "/financial-records";
  } else {
    return (
      <section className="grid items-center h-screen p-8 text-center">
        <div>
          <Typography
            variant="h3"
            color="blue-gray"
            className="mb-2"
            placeholder={undefined}
            onPointerEnterCapture={undefined}
            onPointerLeaveCapture={undefined}
          >
            Sign In
          </Typography>

          <Typography
            className="mb-16 text-gray-600 font-normal text-[18px]"
            placeholder={undefined}
            onPointerEnterCapture={undefined}
            onPointerLeaveCapture={undefined}
          >
            Enter your email and password to sign in
          </Typography>

          <form action="#" className="mx-auto max-w-[24rem] text-left">
            <div className="mb-6">
              <label htmlFor="email">
                <Typography
                  variant="small"
                  className="block mb-2 font-medium text-gray-900"
                  placeholder={undefined}
                  onPointerEnterCapture={undefined}
                  onPointerLeaveCapture={undefined}
                >
                  Your Email
                </Typography>
              </label>
              <Input
                {...register("email")}
                id="email"
                color="gray"
                size="lg"
                type="email"
                name="email"
                placeholder="name@mail.com"
                className="w-full placeholder:opacity-100 focus:border-t-primary border-t-blue-gray-200"
                labelProps={{
                  className: "hidden",
                }}
                onPointerEnterCapture={undefined}
                onPointerLeaveCapture={undefined}
                crossOrigin={undefined}
              />
            </div>

            <div className="mb-6">
              <label htmlFor="password">
                <Typography
                  variant="small"
                  className="block mb-2 font-medium text-gray-900"
                  placeholder={undefined}
                  onPointerEnterCapture={undefined}
                  onPointerLeaveCapture={undefined}
                >
                  Password
                </Typography>
              </label>
              <Input
                {...register("password")}
                size="lg"
                placeholder="********"
                labelProps={{
                  className: "hidden",
                }}
                className="w-full placeholder:opacity-100 focus:border-t-primary border-t-blue-gray-200"
                type={passwordShown ? "text" : "password"}
                icon={
                  <i onClick={togglePasswordVisiblity}>
                    {passwordShown ? (
                      <FaEye size={20} />
                    ) : (
                      <FaEyeSlash size={20} />
                    )}
                  </i>
                }
                onPointerEnterCapture={undefined}
                onPointerLeaveCapture={undefined}
                crossOrigin={undefined}
              />
            </div>

            <Button
              color="gray"
              size="lg"
              className="mt-6"
              fullWidth
              placeholder={undefined}
              onPointerEnterCapture={undefined}
              onPointerLeaveCapture={undefined}
              onClick={() => onLogin()}
              loading={loading}
            >
              sign in
            </Button>
          </form>
        </div>
      </section>
    );
  }
}
