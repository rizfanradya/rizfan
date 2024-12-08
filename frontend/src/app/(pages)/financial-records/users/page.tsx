/* eslint-disable react-hooks/exhaustive-deps */
/* eslint-disable @typescript-eslint/no-explicit-any */
"use client";
import { useEffect, useState } from "react";
import { Card, Input } from "@material-tailwind/react";
import DataTable from "react-data-table-component";
import { FaTrash } from "react-icons/fa6";
import Swal from "sweetalert2";
import FormUser from "./form";
import { useForm } from "react-hook-form";
import axiosInstance from "@/utils/axiosInstance";
import LoadingSpinner from "@/app/components/loading";
import LayoutAdminFinanceRecords from "@/app/components/financial-records";
import { DeleteData } from "@/app/components/deleteData";

export default function Users() {
  const [userInfo, setUserInfo] = useState({
    role: { role: "" },
    username: "",
  });
  const [hitApi, setHitApi] = useState<boolean>(false);
  const [initialLoading, setInitialLoading] = useState<boolean>(true);
  const [loading, setLoading] = useState<boolean>(true);
  const [role, setRole] = useState([]);
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
    (async () => {
      console.log(userInfo);
      try {
        const roleData = await axiosInstance.get(`role?limit=999999&offset=0`);
        setRole(roleData.data.data);
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
          `user?limit=${limit}&offset=${offset}&search=${watch("search")}`
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

  if (initialLoading) {
    return <LoadingSpinner fullScreen={true} />;
  }

  return (
    <LayoutAdminFinanceRecords
      resUserInfo={setUserInfo}
      isActive="/financial-records/users"
      title="User Table"
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
              <FormUser
                mode="add"
                setGetData={setHitApi}
                getData={hitApi}
                roleData={role}
              />
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
              name: "Email",
              selector: (row: any) => row.email,
              sortable: true,
            },
            {
              name: "Role",
              selector: (row: any) => row.role.role,
              sortable: true,
            },
            {
              name: "Action",
              cell: (row: any) => (
                <div className="flex items-center justify-center gap-4">
                  <FormUser
                    data={row}
                    mode="edit"
                    setGetData={setHitApi}
                    getData={hitApi}
                    roleData={role}
                  />
                  <div
                    className="text-red-500 cursor-pointer"
                    onClick={async () =>
                      await DeleteData(`user/${row.id}`, setHitApi, hitApi)
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
