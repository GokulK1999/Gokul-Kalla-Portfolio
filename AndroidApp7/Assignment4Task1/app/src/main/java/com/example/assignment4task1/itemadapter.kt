package com.example.assignment4task1

import android.annotation.SuppressLint
import android.content.Context
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ImageView
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView

// Adapter class for the RecyclerView to display event items
class itemadapter(private val Items: ArrayList<Items>):
    RecyclerView.Adapter<itemadapter.ViewHolder>() {

        // Callback function for item click events
        var onItemClick : ((Items) -> Unit)? = null
        private lateinit var context: Context

        // ViewHolder class to hold item views
        class ViewHolder(itemView: View):RecyclerView.ViewHolder(itemView){
            val imgitem = itemView.findViewById<ImageView>(R.id.imageViewitem)
            val txtName = itemView.findViewById<TextView>(R.id.textViewitem)
            val txtlocation = itemView.findViewById<TextView>(R.id.textViewitem5)
            val txtdate = itemView.findViewById<TextView>(R.id.textViewitem3)
        }

    // Function called when creating a new ViewHolder instance
    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
        // Inflate the item layout and create a new ViewHolder instance
        val view = LayoutInflater.from(parent.context).inflate(R.layout.items_layout,
            parent,false)
        context = parent.context
        return ViewHolder(view)
    }

    // Function called when binding data to a ViewHolder
    @SuppressLint("DiscouragedApi")
    override fun onBindViewHolder(holder: ViewHolder, position: Int) {
        val details = Items.get(position)

        // Get the resource ID for the event image
        val resources = context.resources
        val resourceID: Int = resources.getIdentifier(details.image,"drawable",
            context.packageName)
        println(details.image)


        // Set data to views in the ViewHolder
        holder.imgitem.setImageResource(resourceID)
        holder.txtName.setText(details.title)
        holder.txtlocation.setText(details.location)
        holder.txtdate.setText(details.date)

        // Set click listener for the item view
        holder.itemView.setOnClickListener{
            onItemClick?.invoke(details)
        }
    }

    // Function to return the total number of items in the list
    override fun getItemCount(): Int {
        return Items.size
    }
}
