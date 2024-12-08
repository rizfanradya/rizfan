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
} from "@/app/components/materialTailwind";
import { FaEdit } from "react-icons/fa";
import axiosInstance from "@/utils/axiosInstance";
import { DECODE_TOKEN } from "@/utils/constant";
import { format } from "date-fns";

type dataType = {
  id: number;
  created_at: string;
  name: string;
  amount: number;
  unit_id: number;
  price: number;
};

export default function FormFinancialRecords({
  data,
  mode,
  getData,
  setGetData,
  unitData,
}: {
  data?: dataType;
  mode: string;
  getData: boolean;
  setGetData: Dispatch<SetStateAction<boolean>>;
  unitData: any[];
}) {
  const [open, setOpen] = useState<boolean>(false);
  const [loading, setLoading] = useState<boolean>(false);
  const { register, watch, reset } = useForm<dataType>({
    defaultValues: {
      ...data,
      created_at: data?.created_at
        ? format(new Date(data.created_at), "yyyy-MM-dd")
        : undefined,
    },
  });

  async function onSubmit() {
    try {
      setLoading(true);
      const inputDate = watch("created_at");
      const currentTime = new Date().toLocaleTimeString("en-GB", {
        hour12: false,
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
      });
      const createdAtWithTime = `${inputDate}T${currentTime}`;
      if (mode === "add") {
        await axiosInstance.post(`financial_records`, {
          created_at: createdAtWithTime,
          name: watch("name"),
          amount: watch("amount"),
          unit_id: watch("unit_id"),
          user_id: DECODE_TOKEN?.id,
          price: watch("price"),
        });
      } else {
        await axiosInstance.put(`financial_records/${data?.id}`, {
          created_at: createdAtWithTime,
          name: watch("name"),
          amount: watch("amount"),
          unit_id: watch("unit_id"),
          user_id: DECODE_TOKEN?.id,
          price: watch("price"),
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
          {mode === "add" ? "Add New" : "Edit"} Financial Records
        </DialogHeader>

        <DialogBody
          placeholder={undefined}
          onPointerEnterCapture={undefined}
          onPointerLeaveCapture={undefined}
          className="flex flex-col gap-6"
        >
          <Input
            onPointerEnterCapture={undefined}
            onPointerLeaveCapture={undefined}
            crossOrigin={undefined}
            type="date"
            label="Tanggal"
            {...register("created_at")}
          />

          <Input
            onPointerEnterCapture={undefined}
            onPointerLeaveCapture={undefined}
            crossOrigin={undefined}
            label="Nama"
            {...register("name")}
          />

          <Input
            onPointerEnterCapture={undefined}
            onPointerLeaveCapture={undefined}
            crossOrigin={undefined}
            label="Jumlah"
            {...register("amount")}
          />

          <select
            {...register("unit_id")}
            className="bg-gray-50 border cursor-pointer border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          >
            {unitData.map((doc) => (
              <option value={doc.id} key={doc.id}>
                {doc.unit}
              </option>
            ))}
          </select>

          <Input
            onPointerEnterCapture={undefined}
            onPointerLeaveCapture={undefined}
            crossOrigin={undefined}
            label="Harga"
            {...register("price")}
          />
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
              !watch("created_at") ||
              !watch("name") ||
              !watch("unit_id") ||
              !watch("amount") ||
              !watch("price")
            }
          >
            Save
          </Button>
        </DialogFooter>
      </Dialog>
    </>
  );
}
