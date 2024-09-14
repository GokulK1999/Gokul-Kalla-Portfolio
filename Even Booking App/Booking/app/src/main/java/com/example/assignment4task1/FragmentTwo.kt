package com.example.assignment4task1

import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.recyclerview.widget.RecyclerView
import androidx.recyclerview.widget.StaggeredGridLayoutManager

// Fragment representing the second tab in the ViewPager2
// TODO: Rename parameter arguments, choose name that match
// the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
private const val ARG_PARAM1 = "param1"

class FragmentTwo : Fragment() {
    // Parameter to store items for this fragment
    // TODO: Rename and change types of parameters
    private var param1 = ArrayList<Items>()
    private lateinit var onClicked:OnClicked

    // Interface to handle item clicks
    interface  OnClicked {
        fun ClickedItem(url:String)
    }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        arguments?.let {
            // Retrieve items passed as arguments
            param1 = it.getParcelableArrayList<Items>(ARG_PARAM1) as ArrayList<Items>
        }
    }

    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?,
    ): View? {
        // Inflate the layout for this fragment

        val view = inflater.inflate(R.layout.fragment_two, container, false)
        val recyclerView = view.findViewById<RecyclerView>(R.id.RecyclerViewTwo)
        recyclerView.layoutManager = StaggeredGridLayoutManager(2,
            StaggeredGridLayoutManager.VERTICAL)
        val itemadapter = itemadapter(param1)

        onClicked = activity as OnClicked

        itemadapter.onItemClick = {
            // Handle item click
            onClicked.ClickedItem(it.url)
        }
        return view
    }

    companion object {
        // Method to create a new instance of this fragment
        // TODO: Rename and change types and number of parameters
        @JvmStatic
        fun newInstance(param1: ArrayList<Items>) =
            FragmentOne().apply {
                arguments = Bundle().apply {
                    // Pass items as arguments
                    putParcelableArrayList(ARG_PARAM1, param1)
                }
            }
    }
}












































