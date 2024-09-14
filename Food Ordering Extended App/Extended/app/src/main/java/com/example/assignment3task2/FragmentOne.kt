package com.example.assignment3task2

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.util.Log
import android.widget.TextView
import android.widget.Toast
import android.widget.CheckBox
import android.widget.RadioGroup
import android.widget.RadioButton
import android.view.ViewGroup
import androidx.fragment.app.Fragment

/**
 * FragmentOne represents the first fragment of the application, responsible for selecting sandwich details.
 */
class FragmentOne : Fragment() {
    init {
        retainInstance = true
    }

    private lateinit var callBack: onButtonClick
    private var sandwichBundle: Bundle?=null

    lateinit var sandwichFilling: TextView
    lateinit var checkBoxHam: CheckBox
    lateinit var checkBoxChicken: CheckBox
    lateinit var checkBoxBeef: CheckBox
    lateinit var checkBoxSalmon: CheckBox
    lateinit var checkBoxKebab: CheckBox
    lateinit var sandwichSide: TextView
    lateinit var checkBoxTomato: CheckBox
    lateinit var checkBoxLettuce: CheckBox
    lateinit var checkBoxOnion: CheckBox
    lateinit var checkBoxCheese: CheckBox
    lateinit var radioButtonGroup: RadioGroup
    lateinit var radioSize6: RadioButton
    lateinit var radioSize9: RadioButton
    lateinit var radioSize12: RadioButton
    lateinit var selectedFillings: ArrayList<String>
    lateinit var selectedSide: ArrayList<String>
    val priceFilling = HashMap<String, Double>()
    val priceSide = HashMap<String, Double>()
    val priceSize = HashMap<String, Double>()
    private lateinit var checkBoxFillings: Array<CheckBox>
    private lateinit var checkBoxSide: Array<CheckBox>
    var currentTotal = 0.0
    var previousSelection = R.id.radioSize6
    var fillingCount = 0
    var radioButtonChosen = 0
    var fillingChosen = ArrayList<String>()
    var sideChosen = ArrayList<String>()

    override fun onResume() {
        super.onResume()
        // Add the price of the selected sandwich size to the current total when the fragment resumes
        when (radioButtonGroup.checkedRadioButtonId) {
            R.id.radioSize6 -> currentTotal += 7
            R.id.radioSize9 -> currentTotal += 9.5
            R.id.radioSize12 -> currentTotal += 13
        }
    }

    /**
     * Interface for passing data of sandwich to the activity.
     */
    interface onButtonClick {
        fun passDataOfSandwich(infoSandwich: Bundle)
    }
    /**
     * Lifecycle method called when the fragment is created.
     */
    override fun onCreate(savedInstanceState: Bundle?){
        super.onCreate(savedInstanceState)
        sandwichBundle = arguments?.getBundle("sandwichBundle") ?: Bundle()
        fillingChosen = sandwichBundle?.getStringArrayList("selectedFillings") ?: ArrayList()
        sideChosen = sandwichBundle?.getStringArrayList("selectedSide") ?: ArrayList()
        radioButtonChosen = sandwichBundle?.getInt("checkedRadioButtonGroup") ?: 0
    }

    /**
     * Lifecycle method called when the fragment's view is created.
     */
    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        // Inflate the layout for this fragment
        val view = inflater.inflate(R.layout.fragment_one, container, false)
        initUI(view)
        setupHandlers()
        setupSwipeListener(view)
        return view
    }

    /**
     * Setup event handlers for UI elements.
     */
    private fun setupHandlers() {
        currentTotal = 0.0
        sizeSelectionHandler()
        fillingSelectionHandler()
        sideSelectionHandler()
        callBack = activity as onButtonClick
    }

    /**
     * Setup swipe listener for swipe gesture detection.
     */
    private fun setupSwipeListener(view: View) {
        view.setOnTouchListener(object : OnSwipeTouchListener(requireContext()) {
            override fun onSwipeLeft() {
                if (fillingCount > 0) {
                    grabOrderDetail(view)
                    fillingCount = 0
                    Log.d("MYTAG", "filling Count"+fillingCount.toString())
                } else {
                    Toast.makeText(requireContext(), "Please make selection of at least 1 filling",
                        Toast.LENGTH_SHORT).show()
                }
            }
        })
    }

    /**
     * Initialize UI elements.
     */
    private fun initUI(view: View){
        //Initialize the UI
        sandwichFilling = view.findViewById(R.id.textviewFilling)
        checkBoxHam = view.findViewById(R.id.checkBoxHam)
        checkBoxChicken = view.findViewById(R.id.checkBoxChicken)
        checkBoxBeef = view.findViewById(R.id.checkBoxBeef)
        checkBoxSalmon = view.findViewById(R.id.checkBoxSalmon)
        checkBoxKebab = view.findViewById(R.id.checkBoxKebab)
        sandwichSide = view.findViewById(R.id.textviewSide)
        checkBoxTomato = view.findViewById(R.id.checkBoxTomato)
        checkBoxLettuce = view.findViewById(R.id.checkBoxLettuce)
        checkBoxOnion = view.findViewById(R.id.checkBoxOnion)
        checkBoxCheese = view.findViewById(R.id.checkBoxCheese)
        radioButtonGroup = view.findViewById(R.id.radioButtonGroup)
        radioSize6 = view.findViewById(R.id.radioSize6)
        radioSize9 = view.findViewById(R.id.radioSize9)
        radioSize12 = view.findViewById(R.id.radioSize12)
        selectedFillings = ArrayList()
        selectedSide = ArrayList()
        checkBoxSide = arrayOf(checkBoxTomato, checkBoxLettuce, checkBoxOnion, checkBoxCheese)
        checkBoxFillings = arrayOf(checkBoxHam, checkBoxChicken, checkBoxBeef, checkBoxSalmon,
            checkBoxKebab)
        priceFilling["Ham"] = 2.5
        priceFilling["Chicken"] = 2.0
        priceFilling["Beef"] = 4.5
        priceFilling["Salmon"] = 3.7
        priceFilling["Kebab"] = 4.0
        priceSide["Tomato"] = 1.0
        priceSide["Lettuce"] = 1.2
        priceSide["Onion"] = 0.5
        priceSide["Cheese"] = 1.5
        priceSize["6 Inch"] = 7.0
        priceSize["9 Inch"] = 9.5
        priceSize["12 Inch"] = 13.0
        // Set checked state and event listeners for checkboxes based on previous selections
        if(radioButtonChosen!=0){
            radioButtonGroup.check(radioButtonChosen)
        }
        fillingSelectionHandler()
        sideSelectionHandler()
        checkBoxFillings.forEach { checkBox ->
            val fillingTag = checkBox.tag.toString()
            checkBox.isChecked = fillingTag in fillingChosen
        }

        checkBoxSide.forEach { checkBox ->
            val sideTag = checkBox.tag.toString()
            checkBox.isChecked = sideTag in sideChosen
        }

    }
    /**
     * Event handler for sandwich size selection.
     */
    private fun sizeSelectionHandler() {
        val sizePriceMap = mapOf(
            R.id.radioSize6 to priceSize["6 Inch"]!!,
            R.id.radioSize9 to priceSize["9 Inch"]!!,
            R.id.radioSize12 to priceSize["12 Inch"]!!
        )

        radioButtonGroup.setOnCheckedChangeListener { _, checkedId ->
            val previousPrice = sizePriceMap[previousSelection] ?: 0.0
            val newPrice = sizePriceMap[checkedId] ?: 0.0

            currentTotal -= previousPrice
            currentTotal += newPrice
            previousSelection = checkedId
        }
    }

    /**
     * Event handler for sandwich filling selection.
     */
    private fun fillingSelectionHandler() {
        val fillingPriceMap = mapOf(
            checkBoxHam.id to "Ham",
            checkBoxChicken.id to "Chicken",
            checkBoxBeef.id to "Beef",
            checkBoxSalmon.id to "Salmon",
            checkBoxKebab.id to "Kebab"
        )

        checkBoxFillings.forEach { checkBoxFilling ->
            checkBoxFilling.setOnCheckedChangeListener { _, isChecked ->
                val filling = fillingPriceMap[checkBoxFilling.id] ?: ""
                var fillingTextView = "Filling"

                if (isChecked) {
                    fillingCount++
                    fillingTextView = "Filling | $filling"
                    currentTotal += priceFilling[filling]!!
                    selectedFillings.add(filling)
                } else {
                    fillingCount--
                    currentTotal -= priceFilling[filling]!!
                    selectedFillings.remove(filling)
                }

                // Disable checkboxes if three fillings are selected
                if (fillingCount == 3) {
                    checkBoxFillings.forEach { checkbox ->
                        if (!checkbox.isChecked) {
                            checkbox.isEnabled = false
                        }
                    }
                } else {
                    // Enable all checkboxes if fewer than three fillings are selected
                    checkBoxFillings.forEach { it.isEnabled = true }
                }

                sandwichFilling.text = fillingTextView
            }
        }
    }

    /**
     * Event handler for side selection.
     */
    private fun sideSelectionHandler() {
        val sidePriceMap = mapOf(
            checkBoxTomato.id to "Tomato",
            checkBoxLettuce.id to "Lettuce",
            checkBoxOnion.id to "Onion",
            checkBoxCheese.id to "Cheese"
        )

        checkBoxSide.forEach { sidesCheckBox ->
            sidesCheckBox.setOnCheckedChangeListener { _, isChecked ->
                val side = sidePriceMap[sidesCheckBox.id] ?: ""
                var textViewSide = "Side"

                if (isChecked) {
                    selectedSide.add(side)
                    textViewSide = "Side | $side"
                    currentTotal += priceSide[side] ?: 0.0
                } else {
                    selectedSide.remove(side)
                    currentTotal -= priceSide[side] ?: 0.0
                }

                sandwichSide.text = textViewSide
            }
        }
    }

    /**
     * Store the selected sandwich details and pass them to the activity. Took basic help from AI
     */
    private fun grabOrderDetail(view: View) {
        Log.d("MYTAG", "Total is: $currentTotal")
        val tempBundle = sandwichBundle ?: Bundle()

        tempBundle.putInt("previousSelection", previousSelection)
        tempBundle.putStringArrayList("selectedFillings", selectedFillings)
        tempBundle.putStringArrayList("selectedSide", selectedSide)
        tempBundle.putInt("fillingCount", fillingCount)
        tempBundle.putInt("checkedRadioButtonGroup", radioButtonGroup.checkedRadioButtonId)
        tempBundle.putDouble("currentTotal", currentTotal)

        tempBundle.let { callBack.passDataOfSandwich(it) }

        Log.d("MYTAG", "Total is: $currentTotal")
    }

    /**
     * Companion object providing a factory method for creating a new instance of FragmentOne with arguments.
     */
    companion object {
        @JvmStatic
        fun newInstance(infoSandwich: Bundle) = FragmentOne().apply {
            arguments = Bundle().apply {
                putBundle("sandwichBundle", infoSandwich) //pass infoSandwich as an argument
            }
        }
    }
}













