package com.example.assignment5_task

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.fragment.app.Fragment
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView

class CompletedFragment : Fragment() {

    private lateinit var recyclerView: RecyclerView
    private lateinit var adapter: CompletedTaskAdapter
    private lateinit var dbHelper: TaskDatabaseHelper

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        val view = inflater.inflate(R.layout.fragment_completed, container, false)
        dbHelper = TaskDatabaseHelper(requireContext())
        recyclerView = view.findViewById(R.id.recycler_view_completed_tasks)
        recyclerView.layoutManager = LinearLayoutManager(activity)
        adapter = CompletedTaskAdapter(fetchCompletedTasks())
        recyclerView.adapter = adapter
        return view
    }

    private fun fetchCompletedTasks(): List<Task> {
        return dbHelper.getCompletedTasks()
    }
}

