package com.example.assignment5_task

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.fragment.app.Fragment
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView

class ImportantFragment : Fragment() {

    private lateinit var recyclerView: RecyclerView
    private lateinit var adapter: ImportantTaskAdapter
    private lateinit var dbHelper: TaskDatabaseHelper

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        val view = inflater.inflate(R.layout.fragment_important, container, false)
        dbHelper = TaskDatabaseHelper(requireContext())
        recyclerView = view.findViewById(R.id.recycler_view_important_tasks)
        recyclerView.layoutManager = LinearLayoutManager(activity)
        adapter = ImportantTaskAdapter(fetchImportantTasks())
        recyclerView.adapter = adapter
        return view
    }

    private fun fetchImportantTasks(): List<Task> {
        return dbHelper.getImportantTasks()
    }
}

