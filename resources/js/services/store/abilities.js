
export default (store) => {
    const ability = store.getters.ability

    ability.update([{action: store.state.rules, subject: 'all'}])

    return store.subscribe((mutation) => {
        if (mutation.type == 'createSession') {
            ability.update([{ action: mutation.payload.permissions, subject: 'all' }])
        }
        if (mutation.type == "destroySession") {
            ability.update([])
        }
    })
}
