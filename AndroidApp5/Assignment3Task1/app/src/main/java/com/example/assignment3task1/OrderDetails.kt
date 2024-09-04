package com.example.assignment3task1

import android.os.Parcel
import android.os.Parcelable

// Data class representing order details, implementing Parcelable for object serialization
data class OrderDetails(val image:Int, val hotelname:String, val roomtype:String,
                        val checkindate:String, val checkoutdate:String, val totalamt:String):Parcelable {
                            constructor(parcel: Parcel): this(
                                parcel.readInt(), // Read image resource ID
                                parcel.readString()!!, // Read hotel name
                                parcel.readString()!!, // Read room type
                                parcel.readString()!!, // Read check-in date
                                parcel.readString()!!, // Read check-out date
                                parcel.readString()!!){ // Read total amount

                            }

    // Write object values to parcel
    override fun writeToParcel(parcel: Parcel, flags: Int) {
        parcel.writeInt(image)
        parcel.writeString(hotelname)
        parcel.writeString(roomtype)
        parcel.writeString(checkindate)
        parcel.writeString(checkoutdate)
        parcel.writeString(totalamt)
    }

    // Describe parcel contents
    override fun describeContents(): Int {
        return 0
    }

    // Parcelable creator
    companion object CREATOR : Parcelable.Creator<OrderDetails> {
        // Create a new instance of OrderDetails from the parcel
        override fun createFromParcel(parcel: Parcel): OrderDetails {
            return OrderDetails(parcel)
        }

        // Create a new array of OrderDetails with the specified size
        override fun newArray(size: Int): Array<OrderDetails?> {
            return  arrayOfNulls(size)
        }
    }
}































