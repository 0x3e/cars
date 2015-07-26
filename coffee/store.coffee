class (exports ? this).Store
  @set: (key, value) ->
    localStorage.setItem key, value
    return

  @set_cookie: (key, value) ->
    expires = undefined
    d = undefined
    d = new Date()
    d.setTime d.getTime() + (365 * 24 * 60 * 60 * 1000)
    expires = "; expires=" + d.toGMTString()
    document.cookie = key + "=" + value + "; expires=" + expires + " path=/"
    return

  @get: (key) ->
    localStorage.getItem key

  @get_cookie_value: (name) ->
    i = undefined
    split_keys = undefined
    cookie = undefined
    split_values = undefined
    length = undefined
    cookie = document.cookie
    split_values = cookie.split(";")
    length = split_values.length
    i = 0
    while i < length
      split_keys = split_values[i].split("=")
      split_keys[0] = split_keys[0].replace(/^ /, "")
      return split_keys[1]  if split_keys[0] is name
      i += 1
    ""
