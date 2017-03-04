import React, { Component } from 'react'
import { Link, NavLink } from 'react-router-dom'

class Header extends Component {
  render() {
    return (
      <header className="laravel-header">
        <div className="contents">
          <div className="logo">
            <Link to="/">Laravel</Link>
          </div>
          <nav className="navigation">
            <ul>
              <li><NavLink to="/docs" activeClassName="active">Документация</NavLink></li>
              <li><NavLink to="/articles" activeClassName="active">Статьи</NavLink></li>
              <li><NavLink to="/packages" activeClassName="active">Пакеты</NavLink></li>
              <li>
                <p>Ресурсы</p>
                <ul>
                  <li><Link to="#">Чат</Link></li>
                  <li><Link to="#">Github</Link></li>
                  <li><Link to="#">Документация</Link></li>
                  <li><Link to="#">Сообщество</Link></li>
                </ul>
              </li>
              <li><Link to="/login">Войти</Link></li>
            </ul>
          </nav>
        </div>
      </header>
    )
  }
}

export default Header
