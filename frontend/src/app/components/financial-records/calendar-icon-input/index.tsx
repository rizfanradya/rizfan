/* eslint-disable @typescript-eslint/no-explicit-any */
import React, { useState } from "react";
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";
import { FaCalendarAlt } from "react-icons/fa";
import CalendarContainer from "../../rc-datepicker-container";

export default function CalendarIconInput({ selectedDate, onDateChange }: any) {
  const [isOpen, setIsOpen] = useState(false);

  const handleIconClick = () => {
    setIsOpen(!isOpen);
  };

  return (
    <div className="relative inline-block">
      <div
        className="text-gray-500 cursor-pointer hover:text-gray-700"
        onClick={handleIconClick}
      >
        <FaCalendarAlt size={24} />
      </div>

      {isOpen && (
        <div className="absolute z-50">
          <DatePicker
            selected={selectedDate}
            popperContainer={CalendarContainer}
            onChange={(date) => {
              onDateChange(date);
              setIsOpen(false);
            }}
            inline
          />
        </div>
      )}
    </div>
  );
}
