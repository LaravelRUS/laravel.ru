import React, { Component } from 'react'
import { Link } from 'react-router-dom'

class Header extends Component {
  render() {
    return (
      <header>
        <div>
          <Link to="/">Laravel</Link>
        </div>
        <div>
          <ul>
            <li><Link to="/docs">Документация</Link></li>
            <li><Link to="/articles">Статьи</Link></li>
            <li><Link to="/packages">Пакеты</Link></li>
            <li>
              <p>Ресурсы</p>
              <ul>
                <li><Link to="#">Чат</Link></li>
                <li><Link to="#">Github</Link></li>
                <li><Link to="#">Документация</Link></li>
                <li><Link to="#">Сообщество</Link></li>
              </ul>
            </li>
            <li><Link to="/login">Логин</Link></li>
          </ul>
        </div>
      </header>
    )
  }
}

export default Header
