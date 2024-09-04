package com.example.assignment5_task

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.fragment.app.Fragment
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView

class OverdueFragment : Fragment() {

    private lateinit var recyclerView: RecyclerView
    private lateinit var adapter: OverdueTaskAdapter
    private lateinit var dbHelper: TaskDatabaseHelper

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        val view = inflater.inflate(R.layout.fragment_overdue, container, false)
        dbHelper = TaskDatabaseHelper(requireContext())
        recyclerView = view.findViewById(R.id.recycler_view_overdue_tasks)
        recyclerView.layoutManager = LinearLayoutManager(activity)
        adapter = OverdueTaskAdapter(fetchOverdueTasks())
        recyclerView.adapter = adapter
        return view
    }

    private fun fetchOverdueTasks(): List<Task> {
        return dbHelper.getOverdueTasks()
    }
}

