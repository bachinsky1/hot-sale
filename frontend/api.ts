
const post = async (route: string, data: any): Promise<any> => { 

    const response = await fetch(route, {
        method: 'POST',
        body: data
    })

    if (response.ok) {
        const result: any = await response.json()
        return result
    } else {
        console.log("HTTP error: " + response.status)
        return false
    }
}

export { post }