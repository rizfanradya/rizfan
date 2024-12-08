/* eslint-disable react-hooks/exhaustive-deps */
/* eslint-disable @typescript-eslint/no-explicit-any */
import { Dispatch, SetStateAction, useState } from "react";
import { useForm } from "react-hook-form";
import Swal from "sweetalert2";
import {
  Button,
  Dialog,
  DialogBody,
  DialogFooter,
  DialogHeader,
  Input,
  Typography,
} from "@material-tailwind/react";
import { FaEdit } from "react-icons/fa";
import { isEmail, isStrongPassword } from "validator";
import { FaEye, FaEyeSlash } from "react-icons/fa6";
import axiosInstance from "@/utils/axiosInstance";

type dataType = {
  id: number;
  email: string;
  password: string;
  role_id: string;
};

export default function FormUser({
  data,
  mode,
  getData,
  setGetData,
  roleData,
}: {
  data?: dataType;
  mode: string;
  getData: boolean;
  setGetData: Dispatch<SetStateAction<boolean>>;
  roleData: any[];
}) {
  const [open, setOpen] = useState<boolean>(false);
  const [loading, setLoading] = useState<boolean>(false);
  const { register, watch, reset } = useForm<dataType>({ defaultValues: data });
  const [inputTypePassword, setInputTypePassword] = useState(true);

  async function onSubmit() {
    try {
      setLoading(true);
      if (mode === "add") {
        await axiosInstance.post(`user`, {
          email: watch("email"),
          password: watch("password"),
          role_id: watch("role_id"),
        });
      } else {
        await axiosInstance.put(`user/${data?.id}`, {
          email: watch("email"),
          password: watch("password"),
          role_id: watch("role_id"),
        });
      }
      handleRefreshData();
      handleOpen();
    } catch (error: any) {
      console.log(error);
      Swal.fire({
        icon: "error",
        title: "Server Error 404",
        text: error.response.data.detail.message,
        allowOutsideClick: false,
      });
    }
    setLoading(false);
  }

  function handleOpen() {
    setOpen(!open);
    reset();
  }
  function handleRefreshData() {
    setGetData(!getData);
  }
  function handleInputTypePassword() {
    setInputTypePassword(!inputTypePassword);
  }

  return (
    <>
      {mode === "add" ? (
        <Button
          onClick={handleOpen}
          variant="gradient"
          color="green"
          placeholder={undefined}
          onPointerEnterCapture={undefined}
          onPointerLeaveCapture={undefined}
        >
          Add New
        </Button>
      ) : (
        <FaEdit
          size={25}
          onClick={handleOpen}
          className="cursor-pointer"
          color="blue"
        />
      )}

      <Dialog
        open={open}
        handler={handleOpen}
        placeholder={undefined}
        onPointerEnterCapture={undefined}
        onPointerLeaveCapture={undefined}
      >
        <DialogHeader
          placeholder={undefined}
          onPointerEnterCapture={undefined}
          onPointerLeaveCapture={undefined}
        >
          {mode === "add" ? "Add New" : "Edit"} user
        </DialogHeader>

        <DialogBody
          placeholder={undefined}
          onPointerEnterCapture={undefined}
          onPointerLeaveCapture={undefined}
          className="flex flex-col gap-4 overflow-y-scroll"
        >
          <div>
            <Typography
              variant="h6"
              placeholder={undefined}
              onPointerEnterCapture={undefined}
              onPointerLeaveCapture={undefined}
            >
              Email
            </Typography>
            <Input
              onPointerEnterCapture={undefined}
              onPointerLeaveCapture={undefined}
              crossOrigin={undefined}
              error={!isEmail(watch("email") ?? "")}
              {...register("email")}
            />
          </div>

          <div>
            <Typography
              variant="h6"
              placeholder={undefined}
              onPointerEnterCapture={undefined}
              onPointerLeaveCapture={undefined}
            >
              Password
            </Typography>
            <Input
              onPointerEnterCapture={undefined}
              onPointerLeaveCapture={undefined}
              crossOrigin={undefined}
              type={inputTypePassword ? "password" : "text"}
              error={!isStrongPassword(watch("password") ?? "")}
              {...register("password")}
              icon={
                inputTypePassword ? (
                  <FaEye
                    size={20}
                    className="cursor-pointer"
                    onClick={handleInputTypePassword}
                  />
                ) : (
                  <FaEyeSlash
                    size={20}
                    className="cursor-pointer"
                    onClick={handleInputTypePassword}
                  />
                )
              }
            />
          </div>

          <div>
            <Typography
              variant="h6"
              placeholder={undefined}
              onPointerEnterCapture={undefined}
              onPointerLeaveCapture={undefined}
            >
              Role
            </Typography>
            <select
              {...register("role_id")}
              className="bg-gray-50 border cursor-pointer border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            >
              {roleData.map((doc) => (
                <option value={doc.id} key={doc.id}>
                  {doc.role}
                </option>
              ))}
            </select>
          </div>
        </DialogBody>

        <DialogFooter
          placeholder={undefined}
          onPointerEnterCapture={undefined}
          onPointerLeaveCapture={undefined}
        >
          <Button
            variant="text"
            color="red"
            onClick={handleOpen}
            loading={loading}
            className="mr-1"
            placeholder={undefined}
            onPointerEnterCapture={undefined}
            onPointerLeaveCapture={undefined}
          >
            Cancel
          </Button>
          <Button
            variant="gradient"
            color="green"
            onClick={onSubmit}
            loading={loading}
            placeholder={undefined}
            onPointerEnterCapture={undefined}
            onPointerLeaveCapture={undefined}
            disabled={
              !watch("role_id") ||
              !isEmail(watch("email") ?? "") ||
              !isStrongPassword(watch("password") ?? "")
            }
          >
            Save
          </Button>
        </DialogFooter>
      </Dialog>
    </>
  );
}
