/* eslint-disable react-hooks/exhaustive-deps */
import {
  Dispatch,
  ReactNode,
  SetStateAction,
  useEffect,
  useState,
} from "react";
import NavbarDefault from "./navbar";
import { HiPresentationChartBar } from "react-icons/hi2";
import DrawerDefault from "./drawer";
import { jwtDecode } from "jwt-decode";
import Sidebar from "./sidebar";
import axiosInstance from "../../../utils/axiosInstance";
import { FaListUl, FaUsers } from "react-icons/fa6";
import { MdSettings } from "react-icons/md";
import {
  ACCESS_TOKEN,
  ACCESS_TOKEN_NAME,
  DECODE_TOKEN,
  REFRESH_TOKEN,
  REFRESH_TOKEN_NAME,
  ROLE_ADMIN,
} from "@/utils/constant";
import LoadingSpinner from "../loading";

export function linkItems(
  sizeIcon: number = 20,
  color: string | undefined = undefined
) {
  return [
    {
      name: "Dashboard",
      href: "/financial-records",
      icon: <HiPresentationChartBar size={sizeIcon} color={color} />,
      role: [ROLE_ADMIN],
      description: "",
    },
    {
      name: "Users",
      href: "/financial-records/users",
      icon: <FaUsers size={sizeIcon} color={color} />,
      role: [ROLE_ADMIN],
      description: "",
    },
    {
      name: "Unit",
      href: "/financial-records/units",
      icon: <FaListUl size={sizeIcon} color={color} />,
      role: [ROLE_ADMIN],
      description: "",
    },
    {
      name: "Role",
      href: "/financial-records/roles",
      icon: <MdSettings size={sizeIcon} color={color} />,
      role: [ROLE_ADMIN],
      description: "",
    },
  ];
}

export default function LayoutAdminFinanceRecords({
  children,
  isActive,
  className = "",
  title,
  resUserInfo,
}: {
  children: ReactNode;
  isActive: string;
  className?: string;
  title: string;
  resUserInfo: Dispatch<
    SetStateAction<{ username: string; role: { role: string } }>
  >;
}) {
  const [open, setOpen] = useState(false);
  const openDrawer = () => setOpen(true);
  const closeDrawer = () => setOpen(false);
  const [loading, setLoading] = useState<boolean>(true);
  const [userInfo, setUserInfo] = useState({
    username: "",
    role: { role: "" },
  });

  useEffect(() => {
    document.title = title;
    (async () => {
      setLoading(true);
      try {
        const responseUser = await axiosInstance.get(
          `user?id=${DECODE_TOKEN?.id}`
        );
        setUserInfo(responseUser.data.data[0]);
        resUserInfo(responseUser.data.data[0]);
      } catch (error) {
        console.log(error);
        if (typeof window !== "undefined") {
          localStorage.removeItem(ACCESS_TOKEN_NAME);
          localStorage.removeItem(REFRESH_TOKEN_NAME);
        }
        setTimeout(() => {
          window.location.href = "/financial-records/login";
        }, 200);
      }
      setLoading(false);
    })();
  }, []);

  useEffect(() => {
    if (ACCESS_TOKEN) {
      const decodedToken = jwtDecode(ACCESS_TOKEN);
      if (decodedToken.exp) {
        const currentTime = Math.floor(Date.now() / 1000);
        const timeToExpire = decodedToken.exp - currentTime;
        const timeoutId = setTimeout(async () => {
          try {
            const response = await axiosInstance.post(`refresh_token`, {
              refresh_token: REFRESH_TOKEN,
            });
            if (typeof window !== "undefined") {
              localStorage.setItem(
                ACCESS_TOKEN_NAME,
                response.data.access_token
              );
              localStorage.setItem(
                REFRESH_TOKEN_NAME,
                response.data.refresh_token
              );
            }
            window.location.reload();
          } catch (error) {
            console.log(error);
            if (typeof window !== "undefined") {
              localStorage.removeItem(ACCESS_TOKEN_NAME);
              localStorage.removeItem(REFRESH_TOKEN_NAME);
            }
            setTimeout(() => {
              window.location.href = "/financial-records/login";
            }, 200);
          }
        }, timeToExpire * 1000);
        return () => clearTimeout(timeoutId);
      }
    }
  }, []);

  const filteredLinkItems = linkItems().filter((item) =>
    item.role.includes(userInfo.role.role)
  );

  if (loading) {
    return <LoadingSpinner fullScreen={true} />;
  }

  if (!ACCESS_TOKEN) {
    window.location.href = "/financial-records/login";
  } else {
    if (userInfo.role.role !== ROLE_ADMIN) {
      if (typeof window !== "undefined") {
        localStorage.removeItem(ACCESS_TOKEN_NAME);
        localStorage.removeItem(REFRESH_TOKEN_NAME);
      }
      setTimeout(() => {
        window.location.href = "/financial-records/login";
      }, 200);
    } else {
      return (
        <div className="relative flex gap-4 px-2 py-4 md:px-4">
          <Sidebar linkItems={filteredLinkItems} isActive={isActive} />
          <DrawerDefault
            linkItems={filteredLinkItems}
            open={open}
            closeDrawer={closeDrawer}
            isActive={isActive}
          />

          <div className="justify-end w-full lg:flex">
            <div className="lg:w-[69%] xl:w-[73%] 2xl:w-[77%]">
              <NavbarDefault
                title={title}
                openDrawer={openDrawer}
                username={userInfo.username}
              />
              <div className={`${className} mt-24`}>{children}</div>
            </div>
          </div>
        </div>
      );
    }
  }
}
