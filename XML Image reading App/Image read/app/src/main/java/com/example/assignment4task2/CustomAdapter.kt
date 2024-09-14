package com.example.assignment4task2

import android.content.Context
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.*
import androidx.recyclerview.widget.RecyclerView
import com.bumptech.glide.Glide

class CustomAdapter(private val Items: ArrayList<Images>, private val
onitemclick: (Images) -> Unit) :RecyclerView.Adapter<CustomAdapter.ViewHolder>() {
    private lateinit var context: Context

    class ViewHolder(itemView: View):RecyclerView.ViewHolder(itemView) {
        val thumbnails = itemView.findViewById<ImageView>(R.id.thumbnails)
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int):
            ViewHolder {
        val view = LayoutInflater.from(parent.context).inflate(R.layout.grid_layout,parent,false)

        context = parent.context
        return ViewHolder(view)
    }

    override fun onBindViewHolder(holder: ViewHolder, position: Int) {
        val details= Items.get(position)
        Glide.with(holder.itemView)
            .load(details.urlthumbnails)
            .into(holder.thumbnails)

        holder.itemView.setOnClickListener{
            onitemclick(details)
        }
    }
    override fun getItemCount (): Int {
        return Items.size
    }
}