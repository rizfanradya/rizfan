/* eslint-disable @typescript-eslint/no-explicit-any */
/* eslint-disable react-hooks/exhaustive-deps */
"use client";
import { useEffect, useState } from "react";
import { useForm } from "react-hook-form";
import Swal from "sweetalert2";
import { Card, Input } from "@/app/components/materialTailwind";
import DataTable from "react-data-table-component";
import { FaTrash } from "react-icons/fa6";
import FormRole from "./form";
import axiosInstance from "@/utils/axiosInstance";
import LoadingSpinner from "@/app/components/loading";
import { DeleteData } from "@/app/components/deleteData";
import LayoutAdminFinanceRecords from "@/app/components/financial-records";

export default function Roles() {
  const [userInfo, setUserInfo] = useState({
    username: "",
    role: { role: "" },
  });
  const [hitApi, setHitApi] = useState<boolean>(false);
  const [loading, setLoading] = useState<boolean>(true);
  const [offset, setOffset] = useState(0);
  const [limit, setLimit] = useState(10);
  const { register, watch } = useForm<{ search: string }>({
    defaultValues: { search: "" },
  });
  const [data, setData] = useState({
    total_data: 0,
    data: [],
  });

  useEffect(() => {
    console.log(userInfo);
    const timeoutId = setTimeout(async () => {
      try {
        setLoading(true);
        const response = await axiosInstance.get(
          `role?limit=${limit}&offset=${offset}&search=${watch("search")}`
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
  }, [watch("search"), hitApi, limit, offset]);

  return (
    <LayoutAdminFinanceRecords
      isActive="/financial-records/roles"
      title="Role Table"
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
            <div className="flex items-center justify-between w-full text-start">
              <FormRole mode="add" setGetData={setHitApi} getData={hitApi} />
              <div>
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
          }
          columns={[
            {
              name: "No",
              selector: (_, index) => index! + 1,
              width: "50px",
            },
            {
              name: "Role",
              selector: (row) => row.role,
              sortable: true,
            },
            {
              name: "Action",
              cell: (row: any) => (
                <div className="flex items-center justify-center gap-4">
                  <FormRole
                    data={row}
                    mode="edit"
                    setGetData={setHitApi}
                    getData={hitApi}
                  />
                  <div
                    className="text-red-500 cursor-pointer"
                    onClick={async () =>
                      await DeleteData(`role/${row.id}`, setHitApi, hitApi)
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
