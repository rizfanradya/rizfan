/* eslint-disable @typescript-eslint/no-explicit-any */
import { Portal } from "react-overlays";
export default function CalendarContainer({ children }: any) {
  const el = document.getElementById("calendar-portal");
  return <Portal container={el}>{children}</Portal>;
}
