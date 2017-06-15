import React, { Component } from 'react'
import { NavLink } from 'react-router-dom'
import { LaravelIcon } from 'components/Icons'

class Header extends Component {
  render() {
    return (
      <header className="laravel-header">
        <nav className="contents">
          <div className="logo">
            <NavLink to="/" exact>
              <LaravelIcon />
              <div className="logo-subtext">
                <p>Laravel</p>
                <p>Русское сообщество</p>
              </div>
            </NavLink>
          </div>
          <ul className="top-navigation">
            <li><NavLink to="/search">Поиск</NavLink></li>
            <li><NavLink to="/login">Вход</NavLink></li>
          </ul>
          <ul className="bottom-navigation">
            <li><NavLink to="/docs">Документация</NavLink></li>
            <li><NavLink to="/articles">Статьи</NavLink></li>
            <li><NavLink to="/jobs">Работа</NavLink></li>
            {/* <li><NavLink to="/karma">Карма</NavLink></li> */}
            {/* <li><NavLink to="/packages">Пакеты</NavLink></li> */}
            {/* <li><NavLink to="#">Вконтакте</NavLink></li> */}
            {/* <li><NavLink to="#">Чат</NavLink></li> */}
            {/* <li><NavLink to="#">Tips</NavLink></li> */}
          </ul>
        </nav>
      </header>
    )
  }
}

export default Header
