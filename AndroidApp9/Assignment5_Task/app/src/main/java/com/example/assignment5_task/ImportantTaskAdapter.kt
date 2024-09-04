package com.example.assignment5_task

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView

class ImportantTaskAdapter(private val tasks: List<Task>) : RecyclerView.Adapter<ImportantTaskAdapter.TaskViewHolder>() {

    inner class TaskViewHolder(itemView: View) : RecyclerView.ViewHolder(itemView) {
        val taskName: TextView = itemView.findViewById(R.id.text_view_task_name)
        val taskDueDate: TextView = itemView.findViewById(R.id.text_view_task_due_date)
        // Add more views if needed
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): TaskViewHolder {
        val itemView = LayoutInflater.from(parent.context).inflate(R.layout.item_task, parent, false)
        return TaskViewHolder(itemView)
    }

    override fun onBindViewHolder(holder: TaskViewHolder, position: Int) {
        val currentTask = tasks[position]
        holder.taskName.text = currentTask.name
        holder.taskDueDate.text = currentTask.dueDate.toString()
        // Bind other task data if needed
    }

    override fun getItemCount() = tasks.size
}
