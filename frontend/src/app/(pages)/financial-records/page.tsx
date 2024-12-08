/* eslint-disable @typescript-eslint/no-explicit-any */
/* eslint-disable react-hooks/exhaustive-deps */
"use client";
import LayoutAdminFinanceRecords from "@/app/components/financial-records";
import axiosInstance from "@/utils/axiosInstance";
import { DECODE_TOKEN } from "@/utils/constant";
import { useEffect, useState } from "react";
import { useForm } from "react-hook-form";
import Swal from "sweetalert2";
import { format } from "date-fns";
import { Card, Input, Typography } from "@/app/components/materialTailwind";
import LoadingSpinner from "@/app/components/loading";
import { FaTrash } from "react-icons/fa6";
import { DeleteData } from "@/app/components/deleteData";
import DataTable from "react-data-table-component";
import { id } from "date-fns/locale";
import FormFinancialRecords from "./form";
import CalendarIconInput from "@/app/components/financial-records/calendar-icon-input";

export default function FinancialRecords() {
  const [userInfo, setUserInfo] = useState({
    username: "",
    role: { role: "" },
  });
  const [initialLoading, setInitialLoading] = useState<boolean>(true);
  const [hitApi, setHitApi] = useState<boolean>(false);
  const [loading, setLoading] = useState<boolean>(true);
  const [offset, setOffset] = useState(0);
  const [limit, setLimit] = useState(10);
  const [unit, setUnit] = useState([]);
  const { register, watch, setValue } = useForm<{ search: string; date: any }>({
    defaultValues: { search: "", date: format(new Date(), "yyyy-MM-dd") },
  });
  const [data, setData] = useState({
    total_data: 0,
    total_day: 0,
    total_week: 0,
    total_month: 0,
    total_year: 0,
    data: [],
  });

  useEffect(() => {
    (async () => {
      console.log(userInfo);
      try {
        const unitData = await axiosInstance.get(`unit?limit=999999&offset=0`);
        setUnit(unitData.data.data);
      } catch (error) {
        console.log(error);
        Swal.fire({
          icon: "error",
          title: "Server Error 404",
          allowOutsideClick: false,
        });
      } finally {
        setInitialLoading(false);
      }
    })();
  }, []);

  useEffect(() => {
    const timeoutId = setTimeout(async () => {
      try {
        setLoading(true);
        const response = await axiosInstance.get(
          `financial_records?limit=${limit}&offset=${offset}&search=${watch(
            "search"
          )}&user_id=${DECODE_TOKEN?.id}&date=${format(
            watch("date"),
            "yyyy-MM-dd"
          )}`
        );
        setData(response.data);
      } catch (error) {
        console.log(error);
        Swal.fire({
          icon: "error",
          title: "Server Error 404",
          allowOutsideClick: false,
        });
      }
      setLoading(false);
    }, 1000);
    return () => clearTimeout(timeoutId);
  }, [watch("search"), watch("date"), hitApi, limit, offset]);

  if (initialLoading) {
    return <LoadingSpinner fullScreen={true} />;
  }

  return (
    <LayoutAdminFinanceRecords
      isActive="/financial-records"
      title="Dashboard"
      resUserInfo={setUserInfo}
    >
      <Card
        className="w-full h-full p-4 overflow-scroll"
        placeholder={undefined}
        onPointerEnterCapture={undefined}
        onPointerLeaveCapture={undefined}
      >
        <DataTable
          data={data.data}
          highlightOnHover={true}
          progressPending={loading}
          progressComponent={<LoadingSpinner fullScreen={false} />}
          pagination
          paginationServer={true}
          paginationTotalRows={data.total_data}
          paginationDefaultPage={1}
          onChangeRowsPerPage={(e) => setLimit(e)}
          onChangePage={(e) => setOffset((e - 1) * limit)}
          subHeader
          subHeaderComponent={
            <div className="w-full text-start">
              <div className="flex items-center justify-between w-full text-start">
                <FormFinancialRecords
                  mode="add"
                  setGetData={setHitApi}
                  getData={hitApi}
                  unitData={unit}
                />
                <div className="flex items-center gap-4">
                  <CalendarIconInput
                    selectedDate={watch("date")}
                    onDateChange={(date: Date) => setValue("date", date)}
                  />

                  <Input
                    onPointerEnterCapture={undefined}
                    onPointerLeaveCapture={undefined}
                    crossOrigin={undefined}
                    value={watch("search")}
                    {...register("search")}
                    label="Search..."
                  />
                </div>
              </div>

              <div className="flex gap-4 mt-4">
                <div>
                  <Typography
                    placeholder={undefined}
                    onPointerEnterCapture={undefined}
                    onPointerLeaveCapture={undefined}
                  >
                    Tanggal
                  </Typography>
                  <Typography
                    placeholder={undefined}
                    onPointerEnterCapture={undefined}
                    onPointerLeaveCapture={undefined}
                  >
                    Total Per Hari
                  </Typography>
                  <Typography
                    placeholder={undefined}
                    onPointerEnterCapture={undefined}
                    onPointerLeaveCapture={undefined}
                  >
                    Total Per Minggu
                  </Typography>
                  <Typography
                    placeholder={undefined}
                    onPointerEnterCapture={undefined}
                    onPointerLeaveCapture={undefined}
                  >
                    Total Per Bulan
                  </Typography>
                  <Typography
                    placeholder={undefined}
                    onPointerEnterCapture={undefined}
                    onPointerLeaveCapture={undefined}
                  >
                    Total Per Tahun
                  </Typography>
                </div>

                <div>
                  <Typography
                    placeholder={undefined}
                    onPointerEnterCapture={undefined}
                    onPointerLeaveCapture={undefined}
                  >
                    :{" "}
                    {format(new Date(watch("date")), "EEEE, dd MMMM yyyy", {
                      locale: id,
                    })}
                  </Typography>
                  <Typography
                    placeholder={undefined}
                    onPointerEnterCapture={undefined}
                    onPointerLeaveCapture={undefined}
                  >
                    : Rp. {data.total_day.toLocaleString()}
                  </Typography>
                  <Typography
                    placeholder={undefined}
                    onPointerEnterCapture={undefined}
                    onPointerLeaveCapture={undefined}
                  >
                    : Rp. {data.total_week.toLocaleString()}
                  </Typography>
                  <Typography
                    placeholder={undefined}
                    onPointerEnterCapture={undefined}
                    onPointerLeaveCapture={undefined}
                  >
                    : Rp. {data.total_month.toLocaleString()}
                  </Typography>
                  <Typography
                    placeholder={undefined}
                    onPointerEnterCapture={undefined}
                    onPointerLeaveCapture={undefined}
                  >
                    : Rp. {data.total_year.toLocaleString()}
                  </Typography>
                </div>
              </div>
            </div>
          }
          columns={[
            {
              name: "No",
              selector: (_, index) => index! + 1,
              width: "50px",
            },
            {
              name: "Hari",
              selector: (row) =>
                row.created_at
                  ? format(new Date(row.created_at), "EEEE", {
                      locale: id,
                    })
                  : "N/A",
              sortable: true,
            },
            {
              name: "Tanggal",
              selector: (row) =>
                row.created_at
                  ? format(new Date(row.created_at), "dd MMMM yyyy", {
                      locale: id,
                    })
                  : "N/A",
              sortable: true,
              width: "155px",
            },
            {
              name: "Waktu",
              selector: (row) =>
                row.created_at
                  ? format(new Date(row.created_at), "HH:mm:ss", {
                      locale: id,
                    })
                  : "N/A",
              sortable: true,
            },
            {
              name: "Nama",
              selector: (row) => row.name,
              sortable: true,
            },
            {
              name: "Jumlah",
              selector: (row) => row.amount,
              sortable: true,
            },
            {
              name: "Satuan",
              selector: (row) => row.unit.unit,
              sortable: true,
            },
            {
              name: "Harga",
              selector: (row) => `Rp. ${row.price.toLocaleString()}`,
              sortable: true,
            },
            {
              name: "Total",
              selector: (row) => `Rp. ${row.total.toLocaleString()}`,
              sortable: true,
            },
            {
              name: "Action",
              cell: (row: any) => (
                <div className="flex items-center justify-center gap-4">
                  <FormFinancialRecords
                    data={row}
                    mode="edit"
                    setGetData={setHitApi}
                    getData={hitApi}
                    unitData={unit}
                  />
                  <div
                    className="text-red-500 cursor-pointer"
                    onClick={async () =>
                      await DeleteData(
                        `financial_records/${row.id}`,
                        setHitApi,
                        hitApi
                      )
                    }
                  >
                    <FaTrash size={20} />
                  </div>
                </div>
              ),
              width: "150px",
            },
          ]}
        />
      </Card>
    </LayoutAdminFinanceRecords>
  );
}
