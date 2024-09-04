package com.example.assignment3task1

import android.os.Parcel
import android.os.Parcelable

// Data class representing details of a hotel
data class Details(
    val image: Int,
    var name: String,
    var area: String,
    var stars: String,
    var rm: String,
    var size: String,
    var distance: String,
    var facilities: String,
    var roomtypes: String
) :Parcelable {
        constructor(parcel: Parcel):this(
            parcel.readInt(), // Read image resource ID
            parcel.readString()!!, // Read hotel name
            parcel.readString()!!, // Read area
            parcel.readString()!!, // Read star rating
            parcel.readString()!!, // Read number of rooms
            parcel.readString()!!, // Read size
            parcel.readString()!!, // Read distance
            parcel.readString()!!, // Read facilities
            parcel.readString()!!) { // Read room types
        }

    // Write object values to parcel
    override fun writeToParcel(parcel: Parcel, flags: Int) {
        parcel.writeInt(image)
        parcel.writeString(name)
        parcel.writeString(area)
        parcel.writeString(stars)
        parcel.writeString(rm)
        parcel.writeString(size)
        parcel.writeString(distance)
        parcel.writeString(facilities)
        parcel.writeString(roomtypes)
    }

    // Describe parcel contents
    override fun describeContents(): Int {
        return 0
    }
    // Parcelable creator
    companion object CREATOR : Parcelable.Creator<Details> {
        // Create a new instance of Details from the parcel
        override fun createFromParcel(parcel: Parcel): Details {
            return Details(parcel)
        }

        // Create a new array of Details with the specified size
        override fun newArray(size: Int): Array<Details?> {
            return arrayOfNulls(size)
        }
    }
}






















