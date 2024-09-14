package com.example.assignment3task1

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ImageView
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView

// Adapter class to populate RecyclerView with hotel details
class CustomAdapter(private var HotelDetails:ArrayList<Details>):RecyclerView.Adapter<CustomAdapter.ViewHolder>() {

    // Click listener for RecyclerView items
    var onItemClick : ((Details) -> Unit)? = null

    // ViewHolder class to hold views for each item in RecyclerView
    class ViewHolder(itemView: View):RecyclerView.ViewHolder(itemView){
        val imghotel = itemView.findViewById<ImageView>(R.id.clover_image)
        val txtName = itemView.findViewById<TextView>(R.id.clover_text)
        val txtloc = itemView.findViewById<TextView>(R.id.clover_locationText)
        val txtrate = itemView.findViewById<TextView>(R.id.clover_rateText)
        val txtprice = itemView.findViewById<TextView>(R.id.clover_price)
    }

    // Create ViewHolder instances
    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
        val view = LayoutInflater.from(parent.context).inflate(R.layout.row_layout,parent,false)
        return ViewHolder(view)
    }
    // Bind data to ViewHolder views
    override fun onBindViewHolder(holder: ViewHolder, position: Int) {
        val details = HotelDetails[position]

        // Set hotel image based on hotel name
        val imageResourceId = when (details.name) {
            "Heritage Apartment" -> R.drawable.room1_icon
            "Ameron Hotel" -> R.drawable.room2_icon
            "Dorsett Studio Apartment" -> R.drawable.room3_icon
            "Travelodge Harbourfront" -> R.drawable.room4_icon
            "Clover Apartment" -> R.drawable.room5_icon
            "Wonderloft Hostel" -> R.drawable.room6_icon
            else -> null
        }
        imageResourceId?.let { holder.imghotel.setImageResource(it) }

        // Set hotel name, location, star rating, and room price
        holder.txtName.text = details.name
        holder.txtloc.text = details.area
        holder.txtrate.text = details.stars

        // Extract and set room price
        val roomtypesarr = details.roomtypes.split(",").toTypedArray()
        val roomtypesselarr = roomtypesarr.last()
        val roompricearr = roomtypesselarr.split("-").toTypedArray()
        holder.txtprice.text = roompricearr[1]

        // Set click listener for item
        holder.itemView.setOnClickListener {
            onItemClick?.invoke(details)
        }
    }

    // Return the number of items in the RecyclerView
    override fun getItemCount(): Int {
        return  HotelDetails.size
    }
}
























