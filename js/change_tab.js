const change = document.getElementsByClassName('navbar_tab_info_noti')
const tabContents = document.querySelectorAll('.tab-content')

const removeActiveItem = () => {
    let tabItems = document.getElementsByClassName('navbar_tab_info_noti')
    let array = Array.from(tabItems)
    array.forEach((e) => {
        if (e.classList.contains('active')) {
            e.classList.remove('active')
        }
    })
}
const removeActiveTabContent = () => {
    Array.from(tabContents).map((e) => {
        if (e.classList.contains('active-tab-content')) {
            e.classList.remove('active-tab-content')
        }
    })
}

const removehidden = () => {
    Array.from(tabContents).map((e) => {
        if (e.classList.contains('hidden')) {
            e.classList.remove('hidden')
        }
    })
}
const handleClick = (event) => {

    removeActiveItem()
    event.target.classList.add('active')
    let dataId = event.target.dataset.id
    removehidden()
    Array.from(tabContents).map((e) => {
        if (e.dataset.id != dataId) {
            e.classList.add('hidden')
        }
    })

    removeActiveTabContent()

    Array.from(tabContents).map((e) => {
        if (e.dataset.id == dataId) {
            e.classList.add('active-tab-content')
        }
    })




}
Array.from(change).forEach((item) => {
    item.addEventListener('click', handleClick)
})


//---------------------------------------------------------------------------------------------------------

const change1 = document.getElementsByClassName('tab-item tab-episode-comment')
const tabContents1 = document.querySelectorAll('.player-sidebar-body')

const removeActiveItem1 = () => {
    let tabItems = document.getElementsByClassName('tab-item tab-episode-comment')
    let array = Array.from(tabItems)
    array.forEach((e) => {
        if (e.classList.contains('activated')) {
            e.classList.remove('activated')
        }
    })
}
const removeActiveTabContent1 = () => {
    Array.from(tabContents1).map((e) => {
        if (e.classList.contains('activated')) {
            e.classList.remove('activated')
        }
    })
}

const removehidden1 = () => {
    Array.from(tabContents1).map((e) => {
        if (e.classList.contains('hidden')) {
            e.classList.remove('hidden')
        }
    })
}
const handleClick1 = (event) => {

    removeActiveItem1()
    event.target.classList.add('activated')
    let dataId = event.target.dataset.id
    removehidden1()
    Array.from(tabContents1).map((e) => {
        if (e.dataset.id != dataId) {
            e.classList.add('hidden')
        }
    })

    removeActiveTabContent()

    Array.from(tabContents1).map((e) => {
        if (e.dataset.id == dataId) {
            e.classList.add('activated')
        }
    })
}
Array.from(change1).forEach((item) => {
    item.addEventListener('click', handleClick1)
})

//---------------------------------------------------------------------------------------------------------

let change2 = document.getElementById('activated_ss')
let tabContents2 = document.getElementById('activated_list_ss')

var dr_ss = document.querySelectorAll('#activated_ss')
$.each(dr_ss, function(k, value) {
    value.addEventListener('click', function() {
        tabContents2.classList.toggle('activated')
    })
})